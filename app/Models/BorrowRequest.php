<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'due_date',
        'returned_date',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'returned_date' => 'date',
        ];
    }

    public function index()
    {   
    $borrows = BorrowRequest::with(['user', 'book'])
        ->latest()
        ->get();

    return view('attendant.borrows.index', compact('borrows'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isOverdue(): bool
    {
        return $this->status === 'approved'
            && $this->due_date
            && $this->due_date->isPast();
    }
}