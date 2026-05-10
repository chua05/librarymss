<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowRequest;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $managedRoles = ['user', 'student', 'attendant', 'librarian'];

        $users = collect();
        $books = collect();
        $borrows = collect();
        $reservations = collect();

        if ($search !== '') {
            $users = User::query()
                ->whereIn('role', $managedRoles)
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%");
                    });
                })
                ->latest()
                ->limit(10)
                ->get();

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

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalBooks' => Book::count(),
            'search' => $search,
            'users' => $users,
            'books' => $books,
            'borrows' => $borrows,
            'reservations' => $reservations,
            'hasSearch' => $search !== '',
        ]);
    }
}
