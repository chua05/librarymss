@extends('user.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        My Borrowed Books
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Track your borrowed books and return status.
    </p>
</div>

<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;padding:15px;">

    <table style="width:100%;border-collapse:collapse;font-size:13px;">

        <thead>
            <tr style="text-align:left;color:#64748b;border-bottom:1px solid #e2e8f0;">
                <th style="padding:10px;">Book</th>
                <th>Status</th>
                <th>Date Borrowed</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($borrows as $borrow)
            <tr style="border-bottom:1px solid #f1f5f9;">

                <td style="padding:10px;">
                    {{ $borrow->book->title ?? 'N/A' }}
                </td>

                <td>
                    <span style="
                        padding:4px 10px;
                        border-radius:999px;
                        font-size:11px;
                        background:
                        {{ $borrow->status == 'approved' ? '#dcfce7' : '#fef9c3' }};
                        color:#0f172a;
                    ">
                        {{ ucfirst($borrow->status) }}
                    </span>
                </td>

                <td>
                    {{ $borrow->created_at->format('M d, Y') }}
                </td>

                <td>
                    @if(in_array($borrow->status, ['pending']))
                        <form method="POST" action="{{ route('user.borrows.cancel', $borrow) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                style="border:none;
                                background:none;
                                color:#ef4444;
                                font-size:25px;
                                cursor:pointer;
                                padding:0 14px;
                                align-items:center;
                                display:flex;
                                justify-content:center;
                                ">
                                🗑
                            </button
                        </form>
                    @else
                        <span style="color:#94a3b8;">—</span>
                    @endif
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4" style="padding:30px;text-align:center;color:#64748b;">
                    No borrowed books yet.
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>

</div>

@endsection