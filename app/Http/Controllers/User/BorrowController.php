<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowRequest;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // ❗ CHECK 1: available copies
        if ($book->quantity < 1) {
            return back()->with('error', 'Sorry, no copies of this book are currently available.');
        }

        // ❗ CHECK 2: prevent duplicate borrow request
        $existing = BorrowRequest::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active borrow request for this book.');
        }

        // ❗ CHECK 3: MAX 3 ACTIVE BORROWS + RESERVATIONS
        $activeBorrows = BorrowRequest::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        $activeReservations = \App\Models\Reservation::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if (($activeBorrows + $activeReservations) >= 3) {
            return back()->with('error', 'You may only have up to 3 active borrowed or reserved books.');
        }

        // CREATE BORROW REQUEST
        BorrowRequest::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Borrow request submitted. Please wait for librarian approval.');
    }

    public function myBorrows()
    {
        $borrows = BorrowRequest::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.borrows.my', compact('borrows'));
    }

    // ADDED
    public function cancel(BorrowRequest $borrowRequest)
    {
        if ($borrowRequest->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($borrowRequest->status, ['pending'])) {
            return back()->with('error', 'This borrow request cannot be cancelled.');
        }

        $borrowRequest->delete();

        return back()->with('success', 'Borrow request removed.');
    }
}