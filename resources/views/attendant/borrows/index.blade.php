@extends('attendant.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Borrow Requests
    </h1>
    <p style="font-size:13px;color:#64748b;">
        Approve or reject book borrowing requests from students.
    </p>
</div>

<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;font-size:14px;">

        <thead>
            <tr style="background:#f8fafc;">
                <th style="text-align:left;padding:12px;color:#64748b;font-size:12px;">STUDENT</th>
                <th style="text-align:left;padding:12px;color:#64748b;font-size:12px;">BOOK</th>
                <th style="text-align:left;padding:12px;color:#64748b;font-size:12px;">DATE REQUESTED</th>
                <th style="text-align:left;padding:12px;color:#64748b;font-size:12px;">STATUS</th>
                <th style="text-align:left;padding:12px;color:#64748b;font-size:12px;">ACTIONS</th>
            </tr>
        </thead>

        <tbody>

        @forelse($borrows as $borrow)

            <tr style="border-top:1px solid #f1f5f9;">

                {{-- STUDENT --}}
                <td style="padding:12px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;border-radius:50%;background:rgb(205,73,223);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;">
                            {{ strtoupper(substr($borrow->user->name, 0, 1)) }}
                        </div>
                        <span>{{ $borrow->user->name }}</span>
                    </div>
                </td>

                {{-- BOOK --}}
                <td style="padding:12px;color:#475569;">
                    {{ $borrow->book->title }}
                </td>

                {{-- DATE --}}
                <td style="padding:12px;color:#475569;">
                    {{ $borrow->created_at->format('M d, Y') }}
                </td>

                {{-- STATUS --}}
                <td style="padding:12px;">
                    @if($borrow->status == 'pending')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#fef3c7;color:#92400e;">
                            Pending
                        </span>
                    @elseif($borrow->status == 'approved')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#dcfce7;color:#166534;">
                            Approved
                        </span>
                    @elseif($borrow->status == 'rejected')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#fee2e2;color:#991b1b;">
                            Rejected
                        </span>
                    @elseif($borrow->status == 'returned')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#e0f2fe;color:#075985;">
                            Returned
                        </span>
                    @endif
                </td>

                {{-- ACTIONS --}}
                <td style="padding:12px;">

                    @if($borrow->status == 'pending')

                        <div style="display:flex;gap:8px;">

                            {{-- APPROVE --}}
                            <form method="POST" action="{{ route('attendant.borrows.approve', $borrow->id) }}">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px;border:none;border-radius:8px;background:#22c55e;color:white;font-size:12px;cursor:pointer;">
                                    Approve
                                </button>
                            </form>

                            {{-- REJECT --}}
                            <form method="POST" action="{{ route('attendant.borrows.reject', $borrow->id) }}">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px;border:none;border-radius:8px;background:#ef4444;color:white;font-size:12px;cursor:pointer;">
                                    Reject
                                </button>
                            </form>

                        </div>

                    @elseif($borrow->status == 'approved')

                        <form method="POST" action="{{ route('attendant.borrows.return', $borrow->id) }}">
                            @csrf
                            <button type="submit"
                                style="padding:6px 12px;border:none;border-radius:8px;background:#3b82f6;color:white;font-size:12px;cursor:pointer;">
                                Mark Returned
                            </button>
                        </form>

                    @else
                        <span style="color:#94a3b8;font-size:12px;">No actions</span>
                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" style="padding:30px;text-align:center;color:#94a3b8;">
                    No borrow requests found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection