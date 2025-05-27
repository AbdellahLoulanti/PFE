<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">
  <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden p-8 flex flex-col md:flex-row gap-8"
       style="animation: fadeSlideUp 0.8s ease forwards; opacity: 0; transform: translateY(20px);">

    {{-- Image produit --}}
    <div class="md:w-1/2 group rounded-xl overflow-hidden border-4 border-teal-500 shadow-md transition-all duration-500 hover:shadow-lg hover:border-teal-600 transform hover:scale-105">
      @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}"
             alt="{{ $product->name }}"
             class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105" />
      @else
        <div class="bg-gray-100 h-64 flex items-center justify-center text-gray-400 text-lg font-semibold">
          Pas d’image
        </div>
      @endif
    </div>

    {{-- Détails produit --}}
    <div class="md:w-1/2 flex flex-col justify-between space-y-4">
      <div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h2>
        <p class="text-xl text-teal-700 font-semibold mb-4">{{ number_format($product->price, 2) }} DH</p>

        {{-- Étoiles statiques --}}
        <div class="flex items-center mb-4">
          @for ($i = 1; $i <= 5; $i++)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118L10 13.347l-3.385 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.613 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z"/>
            </svg>
          @endfor
        </div>

        {{-- Description --}}
        <p class="text-gray-700 text-sm leading-relaxed mb-6">
          {{ $product->description ?? 'Description non disponible.' }}
        </p>


<div class="mt-6">
    <livewire:add-to-cart-button :productId="$product->id" />

</div>

    </div>
  </div>

  <style>
    @keyframes fadeSlideUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</div>