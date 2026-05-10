@extends('attendant.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">
        Borrow Requests
    </h1>
    <p style="font-size:13px;color:#8b6b4f;">
        Approve or reject book borrowing requests from students.
    </p>
</div>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;font-size:14px;">

        <thead>
            <tr style="background:#f3e8dc;">
                <th style="text-align:left;padding:12px;color:#8b6b4f;font-size:12px;">STUDENT</th>
                <th style="text-align:left;padding:12px;color:#8b6b4f;font-size:12px;">BOOK</th>
                <th style="text-align:left;padding:12px;color:#8b6b4f;font-size:12px;">DATE REQUESTED</th>
                <th style="text-align:left;padding:12px;color:#8b6b4f;font-size:12px;">STATUS</th>
                <th style="text-align:left;padding:12px;color:#8b6b4f;font-size:12px;">ACTIONS</th>
            </tr>
        </thead>

        <tbody>

        @forelse($borrows as $borrow)

            <tr style="border-top:1px solid #eadfce;">

                {{-- STUDENT --}}
                <td style="padding:12px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:32px;height:32px;border-radius:50%;background:#b87333;color:white;display:flex;align-items:center;justify-content:center;font-weight:700;">
                            {{ strtoupper(substr($borrow->user->name, 0, 1)) }}
                        </div>
                        <span>{{ $borrow->user->name }}</span>
                    </div>
                </td>

                {{-- BOOK --}}
                <td style="padding:12px;color:#6f543f;">
                    {{ $borrow->book->title }}
                </td>

                {{-- DATE --}}
                <td style="padding:12px;color:#6f543f;">
                    {{ $borrow->created_at->format('M d, Y') }}
                </td>

                {{-- STATUS --}}
                <td style="padding:12px;">
                    @if($borrow->status == 'pending')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#fbead8;color:#8b5a2b;">
                            Pending
                        </span>
                    @elseif($borrow->status == 'approved')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#f2e5d7;color:#7a4b22;">
                            Approved
                        </span>
                    @elseif($borrow->status == 'rejected')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#fff1e8;color:#a24b1d;">
                            Rejected
                        </span>
                    @elseif($borrow->status == 'returned')
                        <span style="padding:4px 10px;border-radius:99px;font-size:12px;background:#f6e7d7;color:#8b5a2b;">
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
                                    style="padding:6px 12px;border:none;border-radius:8px;background:#b87333;color:white;font-size:12px;cursor:pointer;">
                                    Approve
                                </button>
                            </form>

                            {{-- REJECT --}}
                            <form method="POST" action="{{ route('attendant.borrows.reject', $borrow->id) }}">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px;border:none;border-radius:8px;background:#b45309;color:white;font-size:12px;cursor:pointer;">
                                    Reject
                                </button>
                            </form>

                        </div>

                    @elseif($borrow->status == 'approved')

                        <form method="POST" action="{{ route('attendant.borrows.return', $borrow->id) }}">
                            @csrf
                            <button type="submit"
                                style="padding:6px 12px;border:none;border-radius:8px;background:#8b5a2b;color:white;font-size:12px;cursor:pointer;">
                                Mark Returned
                            </button>
                        </form>

                    @else
                        <span style="color:#9a7a5f;font-size:12px;">No actions</span>
                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" style="padding:30px;text-align:center;color:#9a7a5f;">
                    No borrow requests found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection