@extends('admin.layout')

@section('content')

@php
    $search = $search ?? '';
    $hasSearch = $hasSearch ?? false;
    $users = $users ?? collect();
    $books = $books ?? collect();
    $borrows = $borrows ?? collect();
    $reservations = $reservations ?? collect();
    $totalUsers = $totalUsers ?? \App\Models\User::count();
    $totalBooks = $totalBooks ?? \App\Models\Book::count();
@endphp

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        Admin Dashboard
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        System overview and management control panel.
    </p>
</div>

<div style="position:relative;margin-bottom:20px;">
    <form method="GET" action="{{ route('admin.dashboard') }}" style="position:relative;">
        <input id="admin-search-input" type="text" name="search" value="{{ $search }}" placeholder="Search users, books, borrows, reservations..."
            style="width:100%;padding:11px 44px 11px 12px;border:1px solid #e7d8c8;border-radius:10px;background:#fdf8f3;outline:none;">
        <button id="admin-search-btn" type="submit"
            style="position:absolute;right:8px;top:50%;transform:translateY(-50%);border:none;background:transparent;color:#8b6b4f;font-size:16px;cursor:pointer;">🔍</button>
    </form>
    @if($hasSearch)
        <div style="position:absolute;top:48px;left:0;right:0;background:#fffdf9;border:1px solid #e7d8c8;border-radius:10px;box-shadow:0 8px 24px rgba(60,42,30,0.10);z-index:20;max-height:320px;overflow:auto;">
            @forelse($users as $result)
                <div style="padding:9px 12px;border-bottom:1px solid #eadfce;font-size:13px;">👤 {{ $result->name }} - {{ $result->email }} ({{ $result->role }})</div>
            @empty
            @endforelse
            @foreach($books as $result)
                <div style="padding:9px 12px;border-bottom:1px solid #eadfce;font-size:13px;">📚 {{ $result->title }} - {{ $result->author }} ({{ $result->isbn }})</div>
            @endforeach
            @foreach($borrows as $result)
                <div style="padding:9px 12px;border-bottom:1px solid #eadfce;font-size:13px;">📄 Borrow: {{ optional($result->user)->name }} - {{ optional($result->book)->title }} ({{ $result->status }})</div>
            @endforeach
            @foreach($reservations as $result)
                <div style="padding:9px 12px;font-size:13px;">🗂 Reservation: {{ optional($result->user)->name }} - {{ optional($result->book)->title }} ({{ $result->status }})</div>
            @endforeach
            @if($users->isEmpty() && $books->isEmpty() && $borrows->isEmpty() && $reservations->isEmpty())
                <div style="padding:10px 12px;color:#8b6b4f;font-size:13px;">No matching results.</div>
            @endif
        </div>
    @endif
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    {{-- USERS --}}
    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">Total Users</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ $totalUsers }}
        </p>
    </div>

    {{-- BOOKS --}}
    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">Total Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ $totalBooks }}
        </p>
    </div>

    {{-- ADMIN ACTIONS / SYSTEM --}}
    <div style="background:#fffdf9;padding:20px;border-radius:12px;border:1px solid #e7d8c8;">
        <h3 style="color:#b87333;font-size:13px;">System Status</h3>
        <p style="font-size:14px;font-weight:600;color:#8a5a2f;">
            Active
        </p>
    </div>

</div>

<script>
    (function () {
        const input = document.getElementById('admin-search-input');
        const button = document.getElementById('admin-search-btn');
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

        <a href="{{ route('admin.users.index') }}"
        class="admindashboard-btn">
            Manage Users
        </a>

        <a href="{{ route('admin.books.index') }}"
        class="admindashboard-btn">
            Manage Books
        </a>

    </div>
</div>

@endsection