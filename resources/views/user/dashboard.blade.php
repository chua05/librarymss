@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        User Dashboard
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Manage your library activities.
    </p>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">My Borrows</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\BorrowRequest::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">My Reservations</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\Reservation::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">Available Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\Book::count() }}
        </p>
    </div>

</div>

{{-- QUICK ACTIONS --}}
<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;padding:20px;">

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