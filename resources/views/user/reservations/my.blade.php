@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        My Reservations
    </h1>

    <p style="font-size:13px;color:#8b6b4f;">
        View and track your reserved books.
    </p>
</div>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;font-size:14px;">

        <thead>
            <tr style="background:#f3e8dc;">
                <th style="padding:12px;text-align:left;">Book</th>
                <th style="padding:12px;text-align:left;">Date Reserved</th>
                <th style="padding:12px;text-align:left;">Status</th>
                <th style="padding:12px;text-align:center;">Action</th>
            </tr>
        </thead>

        <tbody>

        @forelse($reservations as $reservation)

            <tr style="border-top:1px solid #eadfce;">

                {{-- BOOK --}}
                <td style="padding:12px;">
                    {{ $reservation->book->title }}
                </td>

                {{-- DATE --}}
                <td style="padding:12px;color:#6f543f;">
                    {{ $reservation->created_at->format('M d, Y') }}
                </td>

                {{-- STATUS --}}
                <td style="padding:12px;">

                    @if($reservation->status == 'pending')
                        <span style="background:#fbead8;color:#8b5a2b;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Pending
                        </span>

                    @elseif($reservation->status == 'approved')
                        <span style="background:#f2e5d7;color:#7a4b22;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Approved
                        </span>

                    @elseif($reservation->status == 'rejected')
                        <span style="background:#fff1e8;color:#a24b1d;padding:4px 10px;border-radius:99px;font-size:12px;">
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
                                    color:#b45309;
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
                        <span style="color:#9a7a5f;">—</span>
                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="4" style="padding:20px;text-align:center;color:#9a7a5f;">
                    No reservations yet.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection