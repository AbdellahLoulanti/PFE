<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4  pb-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center">Mon Panier</h1>

<div class="mt-4 text-left">
    <a href="{{ route('products') }}"
       class="inline-block text-sm text-teal-700 font-medium hover:underline hover:text-teal-800 transition">
        ← Retour à la boutique
    </a>
</div>

        @if(session()->has('success'))
            <div class="my-6 p-4 bg-gray-100 text-gray-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart))
            <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Articles dans votre panier</h2>

                    <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
                        @foreach($cart as $item)
                            <li class="flex py-6 sm:py-10 relative">
                                <div class="shrink-0">
                                    @if(!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="size-24 rounded-md object-cover sm:size-48">
                                    @else
                                        <div class="size-24 sm:size-48 bg-gray-100 rounded-md flex items-center justify-center text-sm text-gray-500">Pas d'image</div>
                                    @endif
                                </div>

                                <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-sm font-medium text-gray-700">{{ $item['name'] }}</h3>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-gray-900">{{ number_format($item['price'], 2) }} DH</p>
                                        </div>
                                        <div class="flex items-center space-x-2 mt-2">
    <button type="button"
        wire:click="decreaseQuantity({{ $item['id'] }})"
        class="px-2 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition text-sm">
        −
    </button>

    <span class="text-sm font-medium">{{ $item['quantity'] ?? 1 }}</span>

    <button type="button"
        wire:click="increaseQuantity({{ $item['id'] }})"
        class="px-2 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition text-sm">
        +
    </button>
</div>
 <div class="absolute top-0 right-0">
     <button wire:click="removeFromCart({{ $item['id'] }})" type="button" class="-m-2 inline-flex p-2 text-gray-400 hover:text-red-600 transition">
          <span class="sr-only">Supprimer</span>
                <svg class="size-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                 </svg>
     </button>
 </div>


                                    </div>
                                    <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                        <svg class="size-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>En stock</span>
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Résumé de la commande</h2>
                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Sous-total</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ number_format($total, 2) }} DH</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Total</dt>
                            <dd class="text-base font-bold text-gray-900">{{ number_format($total, 2) }} DH</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
<a href="{{ auth()->check() ? route('checkout') : route('login', ['redirect' => route('checkout')]) }}"
    class="block text-center w-full bg-teal-600 text-white px-4 py-3 rounded-md shadow-sm hover:bg-teal-700 transition">
    Commander
</a>


                    </div>
                </section>
            </form>
        @else
            <p class="text-center text-gray-500 mt-10">Votre panier est vide.</p>
        @endif
    </div>
</div>