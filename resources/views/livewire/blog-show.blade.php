<div class="bg-gray-50 py-6">
  <div class="px-4 lg:px-8 w-full max-w-7xl mx-auto">

    <div class="border border-gray-200 rounded-2xl shadow-xl bg-white p-10">

      {{-- Lien de retour --}}
      <div class="mb-6">
        <a href="{{ route('blogs') }}" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Retour aux articles
        </a>
      </div>

      @php
        $fallback = asset('images/default.jpg');
        $imageUrl = $post->image 
            ? asset('storage/' . $post->image) 
            : null;

        if (!$imageUrl) {
            preg_match('/<img[^>]+src="([^">]+)"/', $post->content, $matches);
            $imageUrl = $matches[1] ?? $fallback;
        }

        $contentSansImage = preg_replace('/<img[^>]+>/', '', $post->content);
      @endphp

      {{-- Titre + image vignette à droite --}}
      <div class="flex flex-col lg:flex-row justify-between items-start gap-6">
        <div class="flex-1">
          <time datetime="{{ $post->created_at->toDateString() }}" class="block text-sm text-gray-600 mb-2">
              {{ $post->created_at->translatedFormat('d F Y') }}
          </time>

          <h1 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl hover:text-teal-600 transition">
              {{ $post->title }}
          </h1>
        </div>

        @if($imageUrl)
        <div class="w-[580px] hidden lg:block">
          <img 
            src="{{ $imageUrl }}" 
            alt="Image de l'article"
            class="w-full h-auto rounded-xl shadow-md object-cover"
          >
        </div>
        @endif
      </div>

      {{-- Contenu sur toute la largeur --}}
      <div class="mt-10 text-gray-700 prose prose-lg prose-teal w-full max-w-none">
        {!! $contentSansImage !!}
      </div>

    </div>
  </div>

  <style>
    .prose h2,
    .prose h3 {
      font-weight: 700;
    }
  </style>
</div>
