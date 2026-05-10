@extends('admin.layout')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h1 style="font-size:22px;font-weight:700;color:#3c2a1e;">Books</h1>
        <p style="font-size:13px;color:#8b6b4f;">Manage library books</p>
    </div>

    <a href="{{ route('admin.books.create') }}"
       style="padding:10px 16px;background:#b87333;color:white;border-radius:10px;text-decoration:none;font-size:13px;">
        + Add Book
    </a>
</div>

<div style="background:#fffdf9;border:1px solid #e7d8c8;border-radius:12px;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;font-size:14px;">
        <thead>
            <tr style="background:#f3e8dc;">
                <th style="padding:12px;text-align:left;">Title</th>
                <th style="padding:12px;text-align:left;">Author</th>
                <th style="padding:12px;text-align:left;">Category</th>
                <th style="padding:12px;text-align:left;">Copies</th>

                {{-- ADDED --}}
                <th style="padding:12px;text-align:left;">Status</th>

                <th style="padding:12px;text-align:center;">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($books as $book)
            <tr style="border-top:1px solid #eadfce;">
                <td style="padding:12px;">{{ $book->title }}</td>
                <td style="padding:12px;">{{ $book->author ?? '-' }}</td>
                <td style="padding:12px;">{{ $book->category ?? '-' }}</td>
                <td style="padding:12px;">{{ $book->quantity ?? 1 }}</td>

                {{-- STATUS (ADDED) --}}
                <td style="padding:12px;">
                @php
                    $isBorrowed = \App\Models\BorrowRequest::where('book_id', $book->id)
                        ->where('status', 'approved')
                        ->exists();

                    $isReserved = \App\Models\Reservation::where('book_id', $book->id)
                        ->where('status', 'pending')
                        ->exists();

                    // status chips rendered below
                @endphp

               

                    @if($isBorrowed)
                        <span style="background:#fff1e8;color:#a24b1d;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Borrowed
                        </span>

                    @elseif($isReserved)
                        <span style="background:#f6e7d7;color:#8b5a2b;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Reserved
                        </span>

                    @else
                        <span style="background:#f2e5d7;color:#7a4b22;padding:4px 10px;border-radius:99px;font-size:12px;">
                            Available
                        </span>
                    @endif
                </td>

                {{-- ACTION --}}
                <td style="padding:12px;text-align:center;">

                    <div style="display:flex;gap:8px;justify-content:center;align-items:center;">

                        {{-- EDIT --}}
                        <a href="{{ route('admin.books.edit', $book->id) }}"
                           style="padding:6px 10px;background:#8b5a2b;color:white;border-radius:8px;text-decoration:none;font-size:12px;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this book?')"
                                style="padding:6px 10px;background:#b45309;color:white;border:none;border-radius:8px;font-size:12px;cursor:pointer;">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="padding:20px;text-align:center;color:#9a7a5f;">
                    No books found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection