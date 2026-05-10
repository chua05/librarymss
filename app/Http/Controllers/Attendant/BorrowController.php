<?php

namespace App\Http\Controllers\Attendant;

use App\Http\Controllers\Controller;
use App\Models\BorrowRequest;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = BorrowRequest::with(['user', 'book'])
            ->latest()
            ->get();

        return view('attendant.borrows.index', compact('borrows'));
    }

    public function approve(BorrowRequest $borrowRequest)
    {
        $borrowRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'due_date' => now()->addDays(7),
        ]);

        return back()->with('success', 'Borrow request approved.');
    }

    public function reject(BorrowRequest $borrowRequest)
    {
        $borrowRequest->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return back()->with('success', 'Borrow request rejected.');
    }

    public function markReturned(BorrowRequest $borrowRequest)
    {
        $borrowRequest->update([
            'status' => 'returned',
            'returned_date' => now(),
        ]);

        return back()->with('success', 'Book marked as returned.');
    }
}