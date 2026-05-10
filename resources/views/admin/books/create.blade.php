@extends('admin.layout')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div style="margin-bottom:20px;">
        <h1 style="font-size:22px;font-weight:700;color:#0f172a;">
            Add New Book
        </h1>
        <p style="font-size:13px;color:#64748b;">
            Fill up the book information below.
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

<form method="POST" action="{{ route('admin.books.store') }}" style="width:100%; box-sizing:border-box;">
    @csrf

    <div style="margin-bottom:14px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            Title
        </label>
        <input type="text" name="title" required
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                outline:none;
                font-size:14px;
            ">
    </div>

    <div style="margin-bottom:14px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            Author
        </label>
        <input type="text" name="author" required
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:14px;
                outline:none;
            ">
    </div>

    <div style="margin-bottom:14px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            ISBN
        </label>
        <input type="text" name="isbn" required
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:14px;
                outline:none;
            ">
    </div>

    <div style="margin-bottom:14px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            Category
        </label>
        <input type="text" name="category" required
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:14px;
                outline:none;
            ">
    </div>

    <div style="margin-bottom:14px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            Quantity
        </label>
        <input type="number" name="quantity" min="1" required
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:14px;
                outline:none;
            ">
    </div>

    <div style="margin-bottom:18px;">
        <label style="font-size:13px;font-weight:600;color:#475569;display:block;margin-bottom:6px;">
            Description
        </label>
        <textarea name="description"
            style="
                width:100%;
                box-sizing:border-box;
                padding:10px 12px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:14px;
                outline:none;
                min-height:90px;
                resize:vertical;
            "></textarea>
    </div>

    <button type="submit"
        style="
            padding:10px 16px;
            background:rgb(205,73,223);
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:600;
        ">
        Save Book
    </button>

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

</form>

    </div>
</div>

@endsection