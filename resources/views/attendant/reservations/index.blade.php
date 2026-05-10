@extends('attendant.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        Reservation Requests
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        Review and manage student reservation requests.
    </p>
</div>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">
<table style="width:100%;border-collapse:collapse;font-size:14px;">

<thead>
<tr style="background:#f3e8dc;">
    <th style="padding:12px;text-align:left;">Student</th>
    <th style="padding:12px;text-align:left;">Book</th>
    <th style="padding:12px;text-align:left;">Status</th>
    <th style="padding:12px;text-align:center;">Actions</th>
</tr>
</thead>

<tbody>

{{-- PENDING --}}
@forelse($pendingReservations as $reservation)
<tr style="border-top:1px solid #eadfce;">

    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#fbead8;color:#8b5a2b;padding:4px 10px;border-radius:99px;font-size:12px;">
            Pending
        </span>
    </td>

    <td style="padding:12px;text-align:center;">
        <div style="display:flex;justify-content:center;align-items:center;gap:8px;">

            {{-- APPROVE --}}
            <form method="POST" action="{{ route('attendant.reservations.approve', $reservation) }}">
                @csrf
                <button style="padding:6px 12px;border:none;border-radius:8px;background:#b87333;color:white;font-size:12px;cursor:pointer;">
                    Approve
                </button>
            </form>

            {{-- REJECT --}}
            <form method="POST" action="{{ route('attendant.reservations.reject', $reservation) }}">
                @csrf
                <button style="padding:6px 12px;border:none;border-radius:8px;background:#b45309;color:white;font-size:12px;cursor:pointer;">
                    Reject
                </button>
            </form>

        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" style="padding:20px;text-align:center;color:#9a7a5f;">
        No pending reservations.
    </td>
</tr>
@endforelse


{{-- APPROVED --}}
@foreach($approvedReservations as $reservation)
<tr style="border-top:1px solid #eadfce;">

    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#f2e5d7;color:#7a4b22;padding:4px 10px;border-radius:99px;font-size:12px;">
            Approved
        </span>
    </td>

    <td style="padding:12px;text-align:center;">
        <form method="POST" action="{{ route('attendant.reservations.cancel', $reservation) }}">
            @csrf
            <button title="Cancel"
                style="border:none;background:none;font-size:18px;color:#8b6b4f;cursor:pointer;">
                🗑
            </button>
        </form>
    </td>

</tr>
@endforeach


{{-- REJECTED --}}
@foreach($rejectedReservations as $reservation)
<tr style="border-top:1px solid #eadfce;">
    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#fff1e8;color:#a24b1d;padding:4px 10px;border-radius:99px;font-size:12px;">
            Rejected
        </span>
    </td>

    <td style="padding:12px; text-align:center;">
        —
    </td>
</tr>
@endforeach


</tbody>
</table>
</div>

@endsection