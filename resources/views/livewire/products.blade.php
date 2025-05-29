<div class="bg-white pt-0 mt-0">
  <div class="mx-auto max-w-2xl px-4  sm:px-6   lg:max-w-7xl lg:px-8">

<div class="flex justify-end ">
  <livewire:cart-icon />
</div>


    <!-- Titre principal centré avec soulignement -->
    <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-6 relative inline-block">
      Produits disponibles
      <span class="block h-1 w-24 bg-teal-600 mx-auto mt-2 rounded"></span>
    </h2>

   @forelse ($productsGrouped as $category => $items)
    <div class="mb-6">
        <h3 class="text-xl font-semibold text-teal-700 mb-8 text-center tracking-wide">{{ $category }}</h3>

        <div class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            @foreach ($items as $product)
                <div>
                    <!-- Ton code pour afficher le produit -->
                    <div class="relative h-72 w-full overflow-hidden rounded-lg cursor-pointer border border-gray-200 shadow transition duration-300 ease-in-out hover:shadow-xl hover:border-teal-500">
                        <a href="{{ route('showproduct', ['productId' => $product->id]) }}" class="block h-72 w-full overflow-hidden rounded-lg">
                            @if ($product->image)
                                <img 
                                    src="{{ asset('storage/' . $product->image) }}" 
                                    alt="{{ $product->name }}" 
                                    class="object-cover w-full h-full transform transition-transform duration-500 ease-in-out group-hover:scale-110"
                                >
                            @else
                                <div class="flex items-center justify-center h-full bg-gray-200 text-gray-500">Pas d'image</div>
                            @endif
                            <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end p-4 rounded-lg overflow-hidden pointer-events-none">
                                <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50 rounded-lg"></div>
                                <p class="relative text-lg font-semibold text-white">{{ number_format($product->price, 2) }} DH</p>
                            </div>
                        </a>
                    </div>
                    <div class="mt-6 text-center">
                        <h4 class="text-sm font-semibold text-gray-900">{{ $product->name }}</h4>
                        <livewire:add-to-cart-button :productId="$product->id" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <p class="text-gray-500 text-center">Aucun produit disponible.</p>
@endforelse

<div class="mt-6">
    {{ $products->links() }}
</div>
</div>