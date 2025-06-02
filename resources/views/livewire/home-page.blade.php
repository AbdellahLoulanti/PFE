<div>
    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center bg-no-repeat -mt-[55px]" style="background-image: url('/images/ki.png');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50 z-0"></div>

        <!-- Message et contenu -->
        <div class="relative z-20 flex flex-col justify-center items-center h-full text-center px-6 text-white">
            @if (session()->has('success'))
                <div class="mb-6 px-6 py-3 bg-green-100 text-green-800 rounded shadow-lg text-sm max-w-md w-full mx-auto">
                    {{ session('success') }}
                </div>
            @endif

    <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-lg">
        Transformez votre présence en ligne
    </h1>
    <!-- le reste du contenu -->

          <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-lg">
            Transformez votre présence en ligne
          </h1>
          <p class="text-lg md:text-xl max-w-2xl mx-auto mb-10 text-white/90">
            Une plateforme moderne pour les <span class="text-teal-300 font-semibold">entreprises</span> et <span class="text-teal-300 font-semibold">associations</span> — créez un site, partagez vos actualités, gérez vos événements et promouvez vos produits.
          </p>

          <div class="flex flex-wrap justify-center gap-6">
            <a href="{{ route('register') }}"
               class="bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300 hover:scale-105">
              Créer un compte gratuitement
            </a>
            <a href="#features"
               class="text-white border border-white hover:bg-white hover:text-teal-700 font-semibold py-3 px-8 rounded-lg transition duration-300 hover:scale-105">
              Découvrir les fonctionnalités →
            </a>
          </div>
        </div>
      </section>

      <section id="features" class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
          <h2 class="text-4xl font-extrabold text-gray-900 mb-16 tracking-tight">
            Ce que vous pouvez faire avec notre plateforme
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- Card 1 -->
            <div class="bg-teal-600 rounded-3xl p-8 shadow-lg transform transition duration-300 ease-in-out hover:scale-105 hover:-translate-y-1 hover:shadow-2xl text-white">
              <div class="w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-white text-teal-600 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4v16M5 12h7M8 8h8M8 16h8" />
                </svg>
              </div>
              <h3 class="text-2xl font-semibold mb-3">Créer un blog professionnel</h3>
              <p class="text-base leading-relaxed">
                Partagez vos idées et actualités avec une audience ciblée, sans code.
              </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-green-600 rounded-3xl p-8 shadow-lg transform transition duration-300 ease-in-out hover:scale-105 hover:-translate-y-1 hover:shadow-2xl text-white">
              <div class="w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-white text-green-600 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                  <line x1="16" y1="2" x2="16" y2="6" />
                  <line x1="8" y1="2" x2="8" y2="6" />
                  <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
              </div>
              <h3 class="text-2xl font-semibold mb-3">Organiser vos événements</h3>
              <p class="text-base leading-relaxed">
                Publiez, suivez et gérez des événements pour votre communauté ou votre entreprise.
              </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-sky-700 rounded-3xl p-8 shadow-lg transform transition duration-300 ease-in-out hover:scale-105 hover:-translate-y-1 hover:shadow-2xl text-white">
              <div class="w-16 h-16 mb-6 flex items-center justify-center rounded-full bg-white text-sky-600 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4" />
                  <circle cx="7" cy="21" r="1" />
                  <circle cx="17" cy="21" r="1" />
                </svg>
              </div>
              <h3 class="text-2xl font-semibold mb-3">Mettre en avant vos produits</h3>
              <p class="text-base leading-relaxed">
                Créez un mini-site pour présenter votre offre et la rendre visible.
              </p>
            </div>

          </div>
        </div>
      </section>
 <!-- Articles Section -->
<section class="py-24 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-teal-900 mb-16 text-center">
      Inspirez-vous avec nos derniers articles
    </h2>

    @if($posts->isEmpty())
      <div class="flex flex-col items-center justify-center py-12 bg-50 rounded-xl shadow text-center">
        <svg class="w-16 h-16 text-teal-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-lg text-gray-600">Aucun article disponible pour le moment.</p>
      </div>
    @else
      <div class="grid md:grid-cols-3 gap-8">
        @foreach ($posts as $post)
          <article class="bg-gray-50 rounded-xl overflow-hidden shadow hover:shadow-lg transition transform hover:-translate-y-1">
            @php
              preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->content, $image);
              $imageUrl = $image['src'] ?? "https://source.unsplash.com/600x400/?" . urlencode($post->title);
            @endphp
            <img
              src="{{ $imageUrl }}"
              alt="{{ $post->title }}"
              class="w-full h-48 object-cover"
              onerror="this.onerror=null;this.src='{{ asset('images/default.jpg') }}';"
            />
            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $post->title }}</h3>
              <p class="text-gray-600 mb-4 whitespace-pre-line">
                {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 100) !!}
              </p>
              <a href="{{ route('blog.show', $post->slug) }}" class="text-teal-700 font-semibold hover:underline">Lire l’article →</a>
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>


<!-- Events Section -->
<section class="py-24 bg-gradient-to-br from-teal-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-teal-900 mb-16 text-center">Événements à venir</h2>

      @if($events->isEmpty())
        <p class="text-center text-gray-500">Aucun événement prévu pour l’instant.</p>
      @else
        <div class="grid lg:grid-cols-2 gap-10">
          @foreach ($events as $event)
            <a href="{{ route('events.show', ['id' => $event->id]) }}" class="flex items-stretch bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition hover:-translate-y-1">

              <!-- Colonne gauche avec image + date -->
              <div class="bg-teal-700 text-white flex flex-col items-center px-3 py-4 w-36">

                <!-- Image de l'événement -->
                <img src="{{ $event->cover_image_url }}" alt="Image de l'événement"
                    class="w-36 h-36 object-cover mb-4 rounded-md border-2 border-white shadow-sm">

                <!-- Date verticale -->
                <span class="text-3xl font-bold">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                <span class="uppercase text-sm tracking-widest">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span>
                <span class="text-xs mt-2">→ {{ \Carbon\Carbon::parse($event->end_date)->format('d/m') }}</span>
              </div>

              <!-- Colonne info -->
              <div class="flex-1 p-6">
                <h3 class="text-2xl font-semibold text-teal-800 mb-2">{{ $event->title }}</h3>
                <p class="text-sm text-gray-500 mb-1">{{ $event->location }}</p>
                <p class="text-gray-700 text-sm mb-3">{{ \Illuminate\Support\Str::limit($event->description, 130) }}</p>
                <p class="text-teal-600 text-sm font-semibold hover:underline cursor-pointer">Voir plus →</p>
            </div>

            </a>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <!-- Products Section -->

<section id="products" class="py-24 bg-gradient-to-br from-teal-50 to-white"  >
<div class="max-w-7xl mx-auto px-6">
  <h2 class="text-4xl font-bold text-teal-900 mb-16 text-center">
    Découvrez nos produits
  </h2>

  @if($products->isEmpty())
    <div class="flex flex-col items-center justify-center py-12 bg-gray-50 rounded-xl shadow text-center">
      <svg class="w-16 h-16 text-teal-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <p class="text-lg text-gray-600">Aucun produit disponible pour le moment.</p>
    </div>
  @else
    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
      @foreach ($products as $product)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1 p-6 flex flex-col items-center text-center">

          <div class="bg-white rounded-xl p-2 flex items-center justify-center mb-4 max-h-48">
            <img
              src="{{ asset('storage/' . $product->image) }}"
              alt="{{ $product->name }}"
              class="object-contain max-w-full max-h-48"
              onerror="this.onerror=null;this.src='{{ asset('images/default-product.jpg') }}';"
            />
          </div>

          <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
          <p class="text-gray-600 text-md my-2">{{ number_format($product->price, 2) }} Dh</p>
          <a href="{{ route('showproduct', $product->id) }}"
             class="mt-auto bg-teal-700 hover:bg-Teal-800 text-white text-sm font-semibold px-6 py-2 rounded-lg transition">
            Voir plus
          </a>
        </div>
      @endforeach
    </div>
  @endif
</div>



</section>
</div>

