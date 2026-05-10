@extends('attendant.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        Librarian Dashboard
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        Manage borrow requests, returns, and reservations in the system.
    </p>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:14px;">Pending Requests</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\BorrowRequest::where('status','pending')->count() }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:14px;">Borrowed Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\BorrowRequest::where('status','borrowed')->count() }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:14px;">Returned Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\BorrowRequest::where('status','returned')->count() }}
        </p>
    </div>

</div>

{{-- QUICK ACTIONS --}}
<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;padding:20px;">

    <h2 style="font-size:16px;font-weight:600;margin-bottom:15px;">
        Quick Actions
    </h2>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">

        <a href="{{ route('attendant.borrows.index') }}"
        class="available-btn">
            Manage Borrows
        </a>

        <a href="{{ route('attendant.reservations.index') }}"
        class="available-btn">
            Reservations
        </a>

        <a href="{{ route('attendant.books.available') }}"
        class="available-btn">
            View Available Books
        </a>

    </div>

</div>

@endsection