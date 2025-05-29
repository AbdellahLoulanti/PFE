<section class="bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="max-w-2xl mx-auto text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-900">
        Publications récentes
      </h2>
      <p class="mt-2 text-lg text-gray-600">
        Retrouvez nos derniers articles publiés.
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
      @forelse ($posts as $post)
       @php
  preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->content, $image);
  $fallback = asset('images/default.jpg');
  $imageUrl = $image['src'] ?? $fallback;
  $excerpt = \Illuminate\Support\Str::limit(strip_tags($post->content), 100);
@endphp

        <article class="flex flex-col items-start justify-between bg-white rounded-2xl overflow-hidden shadow-sm transition hover:shadow-lg hover:-translate-y-1 border border-gray-200">
          <div class="relative w-full">
            <img 
              src="{{ $imageUrl }}" 
              alt="{{ $post->title }}" 
              class="aspect-video w-full object-cover bg-gray-100"
             
            >
            <div class="absolute inset-0 rounded-2xl ring-1 ring-gray-900/10 ring-inset"></div>
          </div>

          <div class="p-6 w-full flex flex-col justify-between h-full">
            <div class="flex items-center gap-x-4 text-xs text-gray-500 mb-4">
              <time datetime="{{ $post->created_at->toDateString() }}">
                {{ $post->created_at->format('d M Y') }}
              </time>
              <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600">
                Général
              </span>
            </div>

            <div class="group relative">
              <h3 class="text-lg font-semibold text-gray-900 group-hover:text-teal-600 transition-colors duration-200">
                <a href="{{ route('blog.show', $post->slug) }}">
                  <span class="absolute inset-0"></span>
                  {{ $post->title }}
                </a>
              </h3>
              <p class="mt-5 text-sm text-gray-600 line-clamp-3">
                {{ $excerpt }}
              </p>
            </div>

            <a href="{{ route('blog.show', $post->slug) }}" class="mt-6 inline-block text-teal-700 font-semibold hover:underline">
              Lire l’article →
            </a>
          </div>
        </article>
      @empty
        <p class="text-gray-500 col-span-3 text-center">Aucun article trouvé.</p>
      @endforelse
    </div>
        <div class="mt-4 ">
        {{ $posts->links() }}
    </div>
  </div>
</section>