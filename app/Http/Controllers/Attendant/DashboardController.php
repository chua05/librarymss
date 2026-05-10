<?php

namespace App\Http\Controllers\Attendant;

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

        $books = collect();
        $borrows = collect();
        $reservations = collect();

        if ($search !== '') {
            $books = Book::query()
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('author', 'like', "%{$search}%")
                            ->orWhere('isbn', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();

            $borrows = BorrowRequest::query()
                ->with(['user', 'book'])
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                            ->orWhereHas('book', function ($b) use ($search) {
                                $b->where('title', 'like', "%{$search}%")
                                    ->orWhere('author', 'like', "%{$search}%")
                                    ->orWhere('isbn', 'like', "%{$search}%")
                                    ->orWhere('category', 'like', "%{$search}%");
                            })
                            ->orWhere('status', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();

            $reservations = Reservation::query()
                ->with(['user', 'book'])
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"))
                            ->orWhereHas('book', function ($b) use ($search) {
                                $b->where('title', 'like', "%{$search}%")
                                    ->orWhere('author', 'like', "%{$search}%")
                                    ->orWhere('isbn', 'like', "%{$search}%")
                                    ->orWhere('category', 'like', "%{$search}%");
                            })
                            ->orWhere('status', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();
        }

        return view('attendant.dashboard', [
            'pendingRequests' => BorrowRequest::where('status', 'pending')->count(),
            'borrowedBooks' => BorrowRequest::where('status', 'borrowed')->count(),
            'returnedBooks' => BorrowRequest::where('status', 'returned')->count(),
            'search' => $search,
            'books' => $books,
            'borrows' => $borrows,
            'reservations' => $reservations,
            'hasSearch' => $search !== '',
        ]);
    }
}
