@extends('attendant.layout')

@section('content')

<h1 style="font-size:22px;font-weight:700;margin-bottom:15px;">
    Available Books
</h1>

<div style="background:white;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">

<table style="width:100%;border-collapse:collapse;">
    <thead>
        <tr style="background:#f8fafc;">
            <th style="padding:12px;text-align:left;">Title</th>
            <th style="padding:12px;text-align:left;">Author</th>
            <th style="padding:12px;text-align:left;">Category</th>
            <th style="padding:12px;text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
    @foreach($books as $book)
        <tr style="border-top:1px solid #eee;">
            <td style="padding:12px;">{{ $book->title }}</td>
            <td style="padding:12px;">{{ $book->author }}</td>
            <td style="padding:12px;">{{ $book->category }}</td>

            <td style="padding:12px;">

                @php
                    $borrowed = \App\Models\BorrowRequest::where('book_id',$book->id)
                        ->where('status','approved')
                        ->exists();

                    $reserved = \App\Models\Reservation::where('book_id',$book->id)
                        ->where('status','approved')
                        ->exists();
                @endphp

                @if($borrowed)
                    <span style="color:#ef4444;font-weight:600;">Borrowed</span>
                @elseif($reserved)
                    <span style="color:#3b82f6;font-weight:600;">Reserved</span>
                @else
                    <span style="color:#16a34a;font-weight:600;">Available</span>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection