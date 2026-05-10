@extends('admin.layout')

@section('content')

<div style="margin-bottom:20px;">
    <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
        Edit Book
    </h1>

    <p style="font-size:13px;color:#64748b;">
        Update book details below.
    </p>
</div>

<div style="
        background:white;
        border:1px solid #e2e8f0;
        border-radius:12px;
        padding:25px 30px;
        box-sizing: border-box;
        width: 100%;
        max-width: 900px;
        margin: 20px auto 40px auto;
">

<form method="POST" action="{{ route('admin.books.update', $book->id) }}">
    @csrf
    @method('PUT')

    <div style="display:flex;flex-direction:column;gap:14px;">

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Title
            </label>
            <input type="text" name="title" value="{{ $book->title }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Author
            </label>
            <input type="text" name="author" value="{{ $book->author }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                ISBN
            </label>
            <input type="text" name="isbn" value="{{ $book->isbn }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Category
            </label>
            <input type="text" name="category" value="{{ $book->category }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Quantity
            </label>
            <input type="number" name="quantity" value="{{ $book->quantity }}"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    box-sizing:border-box;
                ">
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
                Description
            </label>
            <textarea name="description"
                style="
                    width:100%;
                    padding:10px 12px;
                    border:1px solid #e5e7eb;
                    border-radius:10px;
                    background:#f9fafb;
                    font-size:14px;
                    min-height:100px;
                    resize:vertical;
                    box-sizing:border-box;
                ">{{ $book->description }}</textarea>
        </div>

        <div style="display:flex;gap:10px;align-items:center;margin-top:10px;">

    {{-- UPDATE BUTTON --}}
    <button type="submit"
        style="
            padding:10px 16px;
            background:rgb(205,73,223);
            color:white;
            border:none;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        ">
        Update Book
    </button>

    {{-- CANCEL BUTTON --}}
    <button type="button"
    onclick="window.location.href='{{ route('admin.books.index') }}'"
        style="
            padding:10px 16px;
            background:rgb(228, 228, 228);
            color:black;
            border:none;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        ">
        Cancel
</button>

</div>

    </div>
</form>

</div>

@endsection