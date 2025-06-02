<?php

use App\Livewire\AboutUs;
use App\Livewire\Blogs;
use App\Livewire\BlogShow;
use App\Livewire\Cart;
use App\Livewire\CheckoutForm;
use App\Livewire\ContactUs;
use App\Livewire\Events;
use App\Livewire\EventsList;
use App\Livewire\HomePage;
use App\Livewire\PaymentForm;
use App\Livewire\Products;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

use App\Models\Order;

Route::get('/payment/success', function () {
    $orderData = session('order_data');

    if (!$orderData) {
        return redirect()->route('checkout')->with('error', 'Aucune commande trouvée.');
    }

    $order = Order::create([
        'name' => $orderData['name'],
        'email' => $orderData['email'],
        'phone' => $orderData['phone'],
        'address' => $orderData['address'],
        'city' => $orderData['city'],
        'postal_code' => $orderData['postal_code'],
        'items' => json_encode($orderData['cart']),
        'total' => $orderData['total'],
        'payment_method' => 'online',
    ]);

    foreach ($orderData['cart'] as $item) {
        $order->items()->create([
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);

        $product = \App\Models\Product::find($item['id']);
        if ($product) {
            $product->stock = max(0, $product->stock - $item['quantity']);
            $product->save();
        }
    }

    session()->forget('cart');
    session()->forget('order_data');

    return redirect()->route('home')->with('success', '✅ Paiement réussi. Merci pour votre commande !');
})->name('payment.success');

require __DIR__.'/auth.php';
