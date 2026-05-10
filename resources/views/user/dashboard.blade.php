@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        User Dashboard
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        Manage your library activities.
    </p>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">My Borrows</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\BorrowRequest::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">My Reservations</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\Reservation::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">Available Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\Book::count() }}
        </p>
    </div>

</div>

{{-- QUICK ACTIONS --}}
<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;padding:20px;">

    <h2 style="font-size:16px;font-weight:600;margin-bottom:15px;">
        Quick Actions
    </h2>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">

        <a href="{{ route('user.books.index') }}"
        class="dashboard-btn">
            Browse Books
        </a>

        <a href="{{ route('user.borrows.my') }}"
        class="dashboard-btn">
            My Borrows
        </a>

        <a href="{{ route('user.reservations.my') }}"
        class="dashboard-btn">
            My Reservations
        </a>

    </div>
</div>

@endsection