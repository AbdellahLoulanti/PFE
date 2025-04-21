<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');




Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('members', MemberController::class);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
