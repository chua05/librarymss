@extends('user.layout')

@section('content')

@php
    $search = $search ?? '';
    $hasSearch = $hasSearch ?? false;
    $books = $books ?? collect();
    $borrows = $borrows ?? collect();
    $reservations = $reservations ?? collect();
    $myBorrowsCount = $myBorrowsCount ?? \App\Models\BorrowRequest::where('user_id', auth()->id())->count();
    $myReservationsCount = $myReservationsCount ?? \App\Models\Reservation::where('user_id', auth()->id())->count();
    $availableBooksCount = $availableBooksCount ?? \App\Models\Book::count();
@endphp

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        Student Dashboard
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        Manage your library activities.
    </p>
</div>

<div style="position:relative;margin-bottom:20px;">
    <form method="GET" action="{{ route('user.dashboard') }}" style="position:relative;">
        <input id="user-search-input" type="text" name="search" value="{{ $search }}" placeholder="Search books, my borrows, my reservations..."
            style="width:100%;padding:11px 44px 11px 12px;border:1px solid #e7d8c8;border-radius:10px;background:#fdf8f3;outline:none;">
        <button id="user-search-btn" type="submit"
            style="position:absolute;right:8px;top:50%;transform:translateY(-50%);border:none;background:transparent;color:#8b6b4f;font-size:16px;cursor:pointer;">🔍</button>
    </form>
    @if($hasSearch)
        <div style="position:absolute;top:48px;left:0;right:0;background:#fffdf9;border:1px solid #e7d8c8;border-radius:10px;box-shadow:0 8px 24px rgba(60,42,30,0.10);z-index:20;max-height:320px;overflow:auto;">
            @forelse($books as $result)
                <div style="padding:9px 12px;border-bottom:1px solid #eadfce;font-size:13px;">📚 {{ $result->title }} - {{ $result->author }} ({{ $result->category }})</div>
            @empty
            @endforelse
            @foreach($borrows as $result)
                <div style="padding:9px 12px;border-bottom:1px solid #eadfce;font-size:13px;">📄 Borrow: {{ optional($result->book)->title }} ({{ $result->status }})</div>
            @endforeach
            @foreach($reservations as $result)
                <div style="padding:9px 12px;font-size:13px;">🗂 Reservation: {{ optional($result->book)->title }} ({{ $result->status }})</div>
            @endforeach
            @if($books->isEmpty() && $borrows->isEmpty() && $reservations->isEmpty())
                <div style="padding:10px 12px;color:#8b6b4f;font-size:13px;">No matching results.</div>
            @endif
        </div>
    @endif
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">My Borrows</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ $myBorrowsCount }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">My Reservations</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ $myReservationsCount }}
        </p>
    </div>

    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">Available Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ $availableBooksCount }}
        </p>
    </div>

</div>

<script>
    (function () {
        const input = document.getElementById('user-search-input');
        const button = document.getElementById('user-search-btn');
        if (!input || !button) return;
        const setIcon = () => {
            if (input.value.trim()) {
                button.textContent = '✕';
                button.type = 'button';
                button.onclick = () => {
                    input.value = '';
                    input.form.submit();
                };
            } else {
                button.textContent = '🔍';
                button.type = 'submit';
                button.onclick = null;
            }
        };
        setIcon();
        input.addEventListener('input', setIcon);
    })();
</script>

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