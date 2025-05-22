<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Events;
use App\Livewire\HomePage;
use App\Livewire\EventsList;
use App\Livewire\AboutUs;
use App\Livewire\ContactUs;

Route::get('/', HomePage::class)->name('home');
Route::get('/evenements', EventsList::class)->name('events');
Route::get('/contact', ContactUs::class)->name('contact');
Route::get('/About-Us', AboutUs::class)->name('AboutUs');




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::get('/events/{id}', Events::class)->name('events.show');

require __DIR__.'/auth.php';
