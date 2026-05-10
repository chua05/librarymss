@extends('admin.layout')

@section('content')

<h1 style="font-size:22px;font-weight:700;margin-bottom:15px;color:#3c2a1e;">Registered Users</h1>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">

<table style="width:100%;border-collapse:collapse;">
    <thead>
        <tr style="background:#f3e8dc;">
            <th style="padding:12px;text-align:left;">Name</th>
            <th style="padding:12px;text-align:left;">Email</th>
            <th style="padding:12px;text-align:left;">Role</th>

            {{-- ADDED --}}
            <th style="padding:12px;text-align:center;">Action</th>
        </tr>
    </thead>

    <tbody>
    @foreach($users as $user)
        <tr style="border-top:1px solid #eadfce;">
            <td style="padding:12px;">{{ $user->name }}</td>
            <td style="padding:12px;">{{ $user->email }}</td>
            <td style="padding:12px;color:#b87333;font-weight:600;">
                {{ $user->role }}
            </td>

            {{-- ACTION COLUMN ADDED --}}
            <td style="padding:12px;text-align:center;">
                <div style="display:flex;gap:8px;justify-content:center;">

                    {{-- EDIT BUTTON --}}
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       style="padding:6px 10px;background:#8b5a2b;color:white;border-radius:8px;text-decoration:none;font-size:12px;">
                        Edit
                    </a>

                    {{-- DELETE BUTTON --}}
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this user?')"
                            style="padding:6px 10px;background:#b45309;color:white;border:none;border-radius:8px;font-size:12px;cursor:pointer;">
                            Delete
                        </button>

                    </form>

                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection