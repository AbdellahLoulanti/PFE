<?php
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Events;
use App\Livewire\HomePage;
use App\Livewire\EventsList;
use App\Livewire\AboutUs;
use App\Livewire\ContactUs;

Route::get('/', HomePage::class)->name('home');
Route::get('/events', EventsList::class)->name('events');
Route::get('/events/{id}', Events::class)->name('events.show');
Route::get('/contact', ContactUs::class)->name('contact');
Route::get('/about-us', AboutUs::class)->name('about-us');

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
