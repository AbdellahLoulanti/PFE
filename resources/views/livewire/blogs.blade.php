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
          $fallback = asset('images/default.jpg');
          $imageUrl = $post->image ? asset('storage/' . $post->image) : $fallback;
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
@php
  $tags = $post->tags ? explode(',', $post->tags) : [];
@endphp

<div class="flex items-center gap-x-4 text-xs mb-4">
  <time datetime="{{ $post->created_at->toDateString() }}" class="text-gray-500">
    {{ $post->created_at->format('d M Y') }}
  </time>

  @if (count($tags) > 0 && $tags[0] !== '')
    @foreach ($tags as $tag)
      <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">
        {{ trim($tag) }}
      </span>
    @endforeach
  @else
    <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full">
      Général
    </span>
  @endif
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

    <div class="mt-4">
      {{ $posts->links() }}
    </div>
  </div>
</section>
