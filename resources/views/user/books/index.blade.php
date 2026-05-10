@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Available Books
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Browse and request books for borrowing or reservation.
    </p>
</div>

{{-- BOOK GRID --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;">

@php
    $activeTotal = \App\Models\BorrowRequest::where('user_id', auth()->id())
        ->whereIn('status', ['pending','approved'])
        ->count()
    + \App\Models\Reservation::where('user_id', auth()->id())
        ->whereIn('status', ['pending','approved'])
        ->count();
@endphp

@forelse($books as $book)

    <div style="background:white;border:1px solid #e2e8f0;border-radius:12px;padding:15px;">

        <h3 style="font-size:15px;font-weight:700;color:#0f172a;">
            {{ $book->title }}
        </h3>

        <p style="font-size:12px;color:#64748b;">
            {{ $book->author }}
        </p>

        <p style="font-size:12px;margin-top:5px;">
            Category: {{ $book->category ?? 'N/A' }}
        </p>

        <p style="font-size:12px;">
            Available: {{ $book->quantity ?? 1 }}
        </p>

        <div style="margin-top:10px;display:flex;gap:8px;">

            {{-- BORROW --}}
            <form method="POST" action="{{ route('user.borrow.store') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <button type="submit"
                    @if($activeTotal >= 3) disabled @endif
                    style="padding:6px 10px;background:{{ $activeTotal >= 3 ? '#ccc' : 'rgb(205,73,223)' }};color:white;border:none;border-radius:8px;font-size:12px;cursor:pointer;">
                    {{ $activeTotal >= 3 ? 'Limit Reached' : 'Borrow' }}
                </button>
            </form>

            {{-- RESERVE (FIXED ROUTE NAME) --}}
            <form method="POST" action="{{ route('user.reserve.store') }}">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <button type="submit"
                @if($activeTotal >= 3) disabled @endif
                    style="padding:6px 10px;background:white;border:1px solid #e2e8f0;color:rgb(205,73,223);border-radius:8px;font-size:12px;cursor:pointer;">
                    Reserve
                </button>
            </form>

        </div>
    </div>

@empty
    <p>No books available.</p>
@endforelse

</div>

@endsection