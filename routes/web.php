<?php

use Laravel\Socialite\Facades\Socialite;
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
use App\Livewire\JobsList;
use App\Livewire\JobPost;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Volt\Volt;

Route::get('/', HomePage::class)->name('home');
Route::get('/events', EventsList::class)->name('events');
Route::get('/events/{id}', Events::class)->name('events.show');
Route::get('/contact', ContactUs::class)->name('contact');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/blogs', Blogs::class)->name('blogs');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');
Route::get('/products', Products::class)->name('products');
Route::get('/jobs', JobsList::class)->name('jobs');
Route::get('/jobs/{job}', JobPost::class)->name('jobs.show');
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

// Route de redirection vers Google
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google.redirect');

// Route de callback après l'authentification Google
Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Rechercher ou créer l'utilisateur
        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(16)),
            'avatar' => $googleUser->getAvatar(), // facultatif
        ]);

        Auth::login($user);
        Session::regenerate();

        // 🔁 Redirection selon le rôle ou état du panier
        if ($user->canAccessPanel(Filament::getCurrentPanel())) {
            return redirect()->route('filament.admin.pages.dashboard');
        } elseif (session()->has('cart') && count(session('cart')) > 0) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('home');
        }

    } catch (\Exception $e) {
        // Gestion d'erreur si authentification échoue
        return redirect()->route('login')->with('error', 'Erreur lors de l’authentification Google.');
    }
});

require __DIR__.'/auth.php';
