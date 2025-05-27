<?php
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Events;
use App\Livewire\HomePage;
use App\Livewire\EventsList;
use App\Livewire\AboutUs;
use App\Livewire\ContactUs;
use App\Livewire\Blogs;
use App\Livewire\BlogShow;
use App\Livewire\Cart;
use App\Livewire\CheckoutForm;
use App\Livewire\PaymentForm;
use App\Livewire\Products;
use App\Livewire\ShowProduct;

Route::get('/', HomePage::class)->name('home');
Route::get('/events', EventsList::class)->name('events');
Route::get('/events/{id}', Events::class)->name('events.show');
Route::get('/contact', ContactUs::class)->name('contact');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/blogs', Blogs::class)->name('blogs');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');
Route::get('/products', Products::class)->name('products');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/showproduct/{productId}', ShowProduct::class)->name('showproduct');
Route::get('/checkout', CheckoutForm::class)->name('checkout');
Route::get('/paiement', PaymentForm::class)->name('paiement');

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
