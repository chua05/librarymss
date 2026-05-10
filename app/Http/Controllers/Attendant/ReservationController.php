<?php

namespace App\Http\Controllers\Attendant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
        {
            $pendingReservations = Reservation::with(['user', 'book'])
                ->where('status', 'pending')
                ->latest()
                ->get();

            $approvedReservations = Reservation::with(['user', 'book'])
                ->where('status', 'approved')
                ->latest()
                ->get();

            $rejectedReservations = Reservation::with(['user', 'book'])
                ->where('status', 'rejected')
                ->latest()
                ->get();

            return view('attendant.reservations.index', compact(
                'pendingReservations',
                'approvedReservations',
                'rejectedReservations'
            ));
        }

        public function approve(Reservation $reservation)
        {
            if ($reservation->status !== 'pending') {
                return back()->with('error', 'Already processed.');
            }
        
            $reservation->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
            ]);
        
            return back()->with('success', 'Reservation approved!');
        }

        public function reject(Reservation $reservation)
        {
            if ($reservation->status !== 'pending') {
                return back()->with('error', 'Already processed.');
            }
        
            $reservation->update([
                'status' => 'rejected',
                'approved_by' => auth()->id(),
            ]);
        
            return back()->with('success', 'Reservation rejected.');
        }
    }