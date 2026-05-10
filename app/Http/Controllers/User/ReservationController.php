<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // CHECK duplicate active reservation
        $existing = Reservation::where('user_id', auth()->id())
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active reservation for this book.');
        }

        // LIMIT CHECK (borrow + reserve max 3)
        $activeBorrows = \App\Models\BorrowRequest::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        $activeReservations = Reservation::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        if (($activeBorrows + $activeReservations) >= 3) {
            return back()->with('error', 'You may only have up to 3 active borrowed or reserved books.');
        }

        // CREATE RESERVATION
        Reservation::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'status' => 'pending',
            'reservation_date' => now()->toDateString(),
        ]);

        // ✅ SAME BEHAVIOR AS BORROW CONTROLLER
        return back()->with('success', 'Reservation submitted successfully. Please wait for approval.');
    }

    public function myReservations()
    {
        $reservations = Reservation::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.reservations.my', compact('reservations'));
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($reservation->status, ['pending', 'approved'])) {
            return back()->with('error', 'This reservation cannot be cancelled.');
        }

        $reservation->delete();

        return back()->with('success', 'Reservation removed.');
    }
}