@extends('admin.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Edit User
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Update user details below.
    </p>
</div>

<div style="
        background:white;
        border:1px solid #e2e8f0;
        border-radius:12px;
        padding:25px 30px;
        box-sizing: border-box;
        width: 100%;
        max-width: 900px;
        margin: 20px auto 40px auto;
">

<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div style="display:flex;flex-direction:column;gap:14px;">

        {{-- NAME --}}
        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Name
            </label>
            <input type="text" name="name" value="{{ $user->name }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        {{-- EMAIL --}}
        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Email
            </label>
            <input type="email" name="email" value="{{ $user->email }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        {{-- ROLE --}}
        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Role
            </label>
            <select name="role"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="attendant" {{ $user->role == 'attendant' ? 'selected' : '' }}>Attendant</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        {{-- PASSWORD --}}
        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                New Password (optional)
            </label>
            <input type="password" name="password"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        {{-- BUTTONS --}}
        <div style="display:flex;gap:10px;align-items:center;margin-top:10px;">

            {{-- UPDATE BUTTON --}}
            <button type="submit"
                style="
                    padding:10px 16px;
                    background:rgb(205,73,223);
                    color:white;
                    border:none;
                    border-radius:10px;
                    font-weight:600;
                    cursor:pointer;
                ">
                Update User
            </button>

            {{-- CANCEL BUTTON --}}
            <button type="button"
                onclick="window.location.href='{{ route('admin.users.index') }}'"
                style="
                    padding:10px 16px;
                    background:rgb(228, 228, 228);
                    color:black;
                    border:none;
                    border-radius:10px;
                    font-weight:600;
                    cursor:pointer;
                ">
                Cancel
            </button>

        </div>

    </div>
</form>

</div>

@endsection