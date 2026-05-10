@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        My Reservations
    </h1>

    <p style="font-size:13px;color:#64748b;">
        View and track your reserved books.
    </p>
</div>

<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;font-size:14px;">

        <thead>
            <tr style="background:#f8fafc;">
                <th style="padding:12px;text-align:left;">Book</th>
                <th style="padding:12px;text-align:left;">Date Reserved</th>
                <th style="padding:12px;text-align:left;">Status</th>
                <th style="padding:12px;text-align:center;">Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($reservations as $reservation)

            <tr style="border-top:1px solid #f1f5f9;">

                {{-- BOOK --}}
                <td style="padding:12px;">
                    {{ $reservation->book->title }}
                </td>

                {{-- DATE --}}
                <td style="padding:12px;color:#475569;">
                    {{ $reservation->created_at->format('M d, Y') }}
                </td>

                {{-- STATUS --}}
                <td style="padding:12px;">

                    @if($reservation->status == 'pending')
                        <span style="background:#fef3c7;color:#92400e;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Pending
                        </span>

                    @elseif($reservation->status == 'approved')
                        <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Approved
                        </span>

                    @elseif($reservation->status == 'rejected')
                        <span style="background:#fee2e2;color:#991b1b;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Rejected
                        </span>
                    @endif

                </td>

                {{-- ACTION --}}
                <td style="padding:12px;text-align:center;">

                    @if(in_array($reservation->status, ['pending', 'approved']))

                        <form method="POST" action="{{ route('user.reservations.cancel', $reservation) }}" style="display:inline;">
                            @csrf

                            <button type="submit"
                                title="Cancel Reservation"
                                style="
                                    border:none;
                                    background:none;
                                    color:#ef4444;
                                    font-size:22px;
                                    cursor:pointer;
                                    display:flex;
                                    justify-content:center;
                                    align-items:center;
                                    margin:auto;
                                ">
                                🗑
                            </button>
                        </form>

                    @else
                        <span style="color:#94a3b8;">—</span>
                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="4" style="padding:20px;text-align:center;color:#94a3b8;">
                    No reservations yet.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection