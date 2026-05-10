@extends('attendant.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Reservation Requests
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Review and manage student reservation requests.
    </p>
</div>

<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
<table style="width:100%;border-collapse:collapse;font-size:14px;">

<thead>
<tr style="background:#f8fafc;">
    <th style="padding:12px;text-align:left;">Student</th>
    <th style="padding:12px;text-align:left;">Book</th>
    <th style="padding:12px;text-align:left;">Status</th>
    <th style="padding:12px;text-align:center;">Actions</th>
</tr>
</thead>

<tbody>

{{-- PENDING --}}
@forelse($pendingReservations as $reservation)
<tr style="border-top:1px solid #f1f5f9;">

    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#fef9c3;color:#854d0e;padding:4px 10px;border-radius:99px;font-size:12px;">
            Pending
        </span>
    </td>

    <td style="padding:12px;text-align:center;">
        <div style="display:flex;justify-content:center;align-items:center;gap:8px;">

            {{-- APPROVE --}}
            <form method="POST" action="{{ route('attendant.reservations.approve', $reservation) }}">
                @csrf
                <button style="padding:6px 12px;border:none;border-radius:8px;background:#22c55e;color:white;font-size:12px;cursor:pointer;">
                    Approve
                </button>
            </form>

            {{-- REJECT --}}
            <form method="POST" action="{{ route('attendant.reservations.reject', $reservation) }}">
                @csrf
                <button style="padding:6px 12px;border:none;border-radius:8px;background:#ef4444;color:white;font-size:12px;cursor:pointer;">
                    Reject
                </button>
            </form>

        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" style="padding:20px;text-align:center;color:#94a3b8;">
        No pending reservations.
    </td>
</tr>
@endforelse


{{-- APPROVED --}}
@foreach($approvedReservations as $reservation)
<tr style="border-top:1px solid #f1f5f9;">

    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#dcfce7;color:#15803d;padding:4px 10px;border-radius:99px;font-size:12px;">
            Approved
        </span>
    </td>

    <td style="padding:12px;text-align:center;">
        <form method="POST" action="{{ route('attendant.reservations.cancel', $reservation) }}">
            @csrf
            <button title="Cancel"
                style="border:none;background:none;font-size:18px;color:#6b7280;cursor:pointer;">
                🗑
            </button>
        </form>
    </td>

</tr>
@endforeach


{{-- REJECTED --}}
@foreach($rejectedReservations as $reservation)
<tr style="border-top:1px solid #f1f5f9;">
    <td style="padding:12px;">{{ $reservation->user->name }}</td>
    <td style="padding:12px;">{{ $reservation->book->title }}</td>

    <td style="padding:12px;">
        <span style="background:#fee2e2;color:#991b1b;padding:4px 10px;border-radius:99px;font-size:12px;">
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