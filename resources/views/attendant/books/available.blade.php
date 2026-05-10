@extends('attendant.layout')

@section('content')

<h1 style="font-size:22px;font-weight:700;margin-bottom:15px;color:#3c2a1e;">
    Available Books
</h1>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">

<table style="width:100%;border-collapse:collapse;">
    <thead>
        <tr style="background:#f3e8dc;">
            <th style="padding:12px;text-align:left;">Title</th>
            <th style="padding:12px;text-align:left;">Author</th>
            <th style="padding:12px;text-align:left;">Category</th>
            <th style="padding:12px;text-align:left;">Status</th>
        </tr>
    </thead>

    <tbody>
    @foreach($books as $book)
        <tr style="border-top:1px solid #eadfce;">
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
                    <span style="color:#a24b1d;font-weight:600;">Borrowed</span>
                @elseif($reserved)
                    <span style="color:#8b5a2b;font-weight:600;">Reserved</span>
                @else
                    <span style="color:#b87333;font-weight:600;">Available</span>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection