@extends('admin.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Admin Dashboard
    </h1>

    <p style="font-size:13px;color:#64748b;">
        System overview and management control panel.
    </p>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px;">

    {{-- USERS --}}
    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">Total Users</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\User::count() }}
        </p>
    </div>

    {{-- BOOKS --}}
    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">Total Books</h3>
        <p style="font-size:24px;font-weight:700;">
            {{ \App\Models\Book::count() }}
        </p>
    </div>

    {{-- ADMIN ACTIONS / SYSTEM --}}
    <div style="background:white;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
        <h3 style="color:rgb(205,73,223);font-size:13px;">System Status</h3>
        <p style="font-size:14px;font-weight:600;color:#16a34a;">
            Active
        </p>
    </div>

</div>

{{-- QUICK ACTIONS --}}
<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;padding:20px;">

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