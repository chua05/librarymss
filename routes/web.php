<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Attendant;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Attendant\DashboardController as AttendantDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Breeze Auth Routes
require __DIR__.'/auth.php';

// ─────────────────────────────────────────────
// DASHBOARD REDIRECT (ROLE-BASED)
// ─────────────────────────────────────────────
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'attendant' => redirect()->route('attendant.dashboard'),
        default => redirect()->route('user.dashboard'),
    };
})->name('dashboard');

// ─────────────────────────────────────────────
// PROFILE
// ─────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─────────────────────────────────────────────
// ADMIN ROUTES
// ─────────────────────────────────────────────
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('books', Admin\BookController::class);
        Route::resource('users', Admin\UserController::class);
    });

// ─────────────────────────────────────────────
// ATTENDANT ROUTES
// ─────────────────────────────────────────────
Route::prefix('attendant')
    ->middleware(['auth', 'role:attendant'])
    ->name('attendant.')
    ->group(function () {

        Route::get('/dashboard', [AttendantDashboardController::class, 'index'])
            ->name('dashboard');

        // BORROWS
        Route::get('/borrows', [Attendant\BorrowController::class, 'index'])
            ->name('borrows.index');

        Route::post('/borrows/{borrowRequest}/approve', [Attendant\BorrowController::class, 'approve'])
            ->name('borrows.approve');

        Route::post('/borrows/{borrowRequest}/reject', [Attendant\BorrowController::class, 'reject'])
            ->name('borrows.reject');

        Route::post('/borrows/{borrowRequest}/return', [Attendant\BorrowController::class, 'markReturned'])
            ->name('borrows.return');

        // RESERVATIONS
        Route::get('/reservations', [Attendant\ReservationController::class, 'index'])
            ->name('reservations.index');

        Route::post('/reservations/{reservation}/approve', [Attendant\ReservationController::class, 'approve'])
            ->name('reservations.approve');

        Route::post('/reservations/{reservation}/reject', [Attendant\ReservationController::class, 'reject'])
            ->name('reservations.reject');

        Route::post('/reservations/{reservation}/cancel', [Attendant\ReservationController::class, 'cancel'])
            ->name('reservations.cancel');

        // AVAILABLE BOOKS
        Route::get('/books/available', [Attendant\BookController::class, 'available'])
        ->name('books.available');
    });

// ─────────────────────────────────────────────
// USER ROUTES
// ─────────────────────────────────────────────
Route::prefix('user')
    ->middleware(['auth', 'role:user'])
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        // BOOKS
        Route::get('/books', [User\BookController::class, 'index'])
            ->name('books.index');

        // BORROW
        Route::post('/borrow', [User\BorrowController::class, 'store'])
            ->name('borrow.store');

        Route::get('/my-borrows', [User\BorrowController::class, 'myBorrows'])
            ->name('borrows.my');

        Route::delete('/borrows/{borrowRequest}/cancel', [User\BorrowController::class, 'cancel'])
            ->name('borrows.cancel');

        // RESERVATION
        Route::post('/reserve', [User\ReservationController::class, 'store'])->name('reserve.store');

        Route::get('/my-reservations', [User\ReservationController::class, 'myReservations'])->name('reservations.my');

        Route::post('/reservations/{reservation}/cancel', [User\ReservationController::class, 'cancel'])->name('reservations.cancel');
    });

    Route::get('/test-mail', function () {
        \Mail::raw('Test email from Laravel', function ($message) {
            $message->to('chuakyla21@gmail.com')
                    ->subject('Test Email');
        });
    
        return 'Email sent';
    });