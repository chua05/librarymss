<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $userId = (int) auth()->id();

        $books = collect();
        $borrows = collect();
        $reservations = collect();

        if ($search !== '') {
            $books = Book::query()
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('author', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();

            $borrows = BorrowRequest::query()
                ->with('book')
                ->where('user_id', $userId)
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('book', function ($b) use ($search) {
                            $b->where('title', 'like', "%{$search}%")
                                ->orWhere('author', 'like', "%{$search}%")
                                ->orWhere('category', 'like', "%{$search}%");
                        })
                        ->orWhere('status', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();

            $reservations = Reservation::query()
                ->with('book')
                ->where('user_id', $userId)
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('book', function ($b) use ($search) {
                            $b->where('title', 'like', "%{$search}%")
                                ->orWhere('author', 'like', "%{$search}%")
                                ->orWhere('category', 'like', "%{$search}%");
                        })
                        ->orWhere('status', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();
        }

        return view('user.dashboard', [
            'myBorrowsCount' => BorrowRequest::where('user_id', $userId)->count(),
            'myReservationsCount' => Reservation::where('user_id', $userId)->count(),
            'availableBooksCount' => Book::count(),
            'search' => $search,
            'books' => $books,
            'borrows' => $borrows,
            'reservations' => $reservations,
            'hasSearch' => $search !== '',
        ]);
    }
}
