<div class="bg-gray-50  py-6">
  <div class="px-4 lg:px-8 w-full max-w-7xl mx-auto">

    <div class="border border-gray-200 rounded-2xl shadow-xl bg-white p-10">

      
      <div class="mb-6">
        <a href="{{ route('blogs') }}" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Retour aux articles
        </a>
      </div>

      
      <time datetime="{{ $post->created_at->toDateString() }}" class="block text-sm text-gray-600">
        {{ $post->created_at->translatedFormat('d F Y') }}
      </time>

      
      <h1 class="mt-4 text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl hover:text-teal-600 transition">
        {{ $post->title }}
      </h1>

      
      <div class="mt-6 text-gray-700 prose prose-lg prose-teal max-w-none">

        @php
          preg_match('/<img[^>]+src="([^">]+)"/', $post->content, $matches);
          $imageUrl = $matches[1] ?? null;
          $contentSansImage = preg_replace('/<img[^>]+>/', '', $post->content);
        @endphp

        @if($imageUrl)
          <img 
            src="{{ $imageUrl }}" 
            alt="Image de l'article"
            class="float-right ml-6 mb-4 w-96 rounded-xl shadow-md object-cover"
            style="max-height: 480px;"
          >
        @endif

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