<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FontsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\FontController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Public Routes (گشتی)
|--------------------------------------------------------------------------
*/

Route::get('/', [FontsController::class, 'index'])->name('fonts.index');
Route::get('/fonts', [FontsController::class, 'search'])->name('font.search');
Route::get('/font/{id}', [FontsController::class, 'show'])->name('fonts.show');
Route::get('/about', fn() => view('info'))->name('about');

// ڕووتی دابەزاندن و زیادکردنی ژمارە
Route::get('/fonts/download/{id}', [FontsController::class, 'download'])->name('fonts.download');

// ڕووتی نوێ بۆ ژمارەی دابەزاندن (JSON)
Route::post('/fonts/{font}/increment-download', [FontsController::class, 'incrementDownload'])->name('fonts.increment');
Route::get('/fonts/{font}/download-count', [FontsController::class, 'getDownloadCount'])->name('fonts.count');

Route::get('/api/library/fonts', [FontController::class, 'allFonts']);

/*
|--------------------------------------------------------------------------
| Admin Routes (تایبەت بە بەڕێوەبەر)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboards', [UserController::class, 'index'])
        ->name('dashboard');

    Route::post('/users/{id}/toggle', [UserController::class, 'toggleStatus'])
        ->name('users.toggle');

    Route::post('/users/{id}/role', [UserController::class, 'updateRole'])
        ->name('users.updateRole');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (بەکارهێنەری چووە ژوورەوە)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // ===== ڕووتەکانی پڕۆفایل =====
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        
        // 🎯 ڕووتی ناردنی ئیمەیڵی سەلماندن
        Route::post('/send-verification', [ProfileController::class, 'sendVerificationEmail'])
            ->name('verification.send');
        
        // 🎯 ڕووتی دووبارە ناردنی ئیمەیڵ (ئارەزوومەندانە)
        Route::post('/resend-verification', [ProfileController::class, 'resendVerificationEmail'])
            ->name('verification.resend');
    });

    // ===== ڕووتەکانی فۆنت (CRUD) =====
    Route::prefix('fonts')->name('fonts.')->group(function () {
        Route::get('/create', fn() => view('fonts.create'))->name('create');
        Route::get('/{font}/edit', [DashboardController::class, 'edit'])->name('edit');
        Route::put('/{font}', [DashboardController::class, 'update'])->name('update');
        Route::delete('/{font}', [DashboardController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Verified Email Routes (ئیمەیڵی سەلمێنراو)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // ===== ڕووتەکانی داشبۆرد =====
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    // ===== ڕووتی هەڵگرتنی فۆنت (پێویستی بە ئیمەیڵی سەلمێنراوە) =====
    Route::post('/fonts/store', [DashboardController::class, 'store'])->name('fonts.store');
});

/*
|--------------------------------------------------------------------------
| Email Verification Routes (ڕووتەکانی سەلماندنی ئیمەیڵ)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('email')->name('verification.')->group(function () {
    
    // 🎯 پەیامی ئاگادارکردنەوە (کاتێک دەچیتە شوێنێک کە پێویستی بە سەلماندن هەیە)
    Route::get('/verify', function () {
        return view('auth.verify-email');
    })->name('notice');
    
    // 🎯 ڕووتی سەلماندن (کاتێک لە ئیمەیڵەکە کرتە دەکەیت)
    Route::get('/verify/{id}/{hash}', [ProfileController::class, 'verifyEmail'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verify');
});

/*
|--------------------------------------------------------------------------
| Notification Routes (ڕووتەکانی ئاگادارکردنەوە)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('notifications')->name('notifications.')->group(function () {
    
    // 🎯 نیشاندانی هەموو ئاگادارکردنەوەکان
    Route::get('/', function () {
        return view('notifications.index');
    })->name('index');
    
    // 🎯 خوێندنەوەی ئاگادارکردنەوەیەک
    Route::post('/{id}/read', function ($id) {
        auth()->user()->notifications->where('id', $id)->markAsRead();
        return back();
    })->name('read');
    
    // 🎯 خوێندنەوەی هەموو ئاگادارکردنەوەکان
    Route::post('/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('read.all');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');

});

/*
|--------------------------------------------------------------------------
| Auth Routes (ڕووتەکانی هاتنە ژوورەوە)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';