<section class="bg-gray-50 py-6">
  <div class="px-4 lg:px-8 w-full max-w-7xl mx-auto">

    <div class="border border-gray-200 rounded-2xl shadow-xl bg-white p-10">

      {{-- Lien de retour --}}
      <div class="mb-6">
        <a href="{{ route('events') }}" class="inline-flex items-center text-teal-600 hover:text-teal-800 text-sm font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Retour aux événements
        </a>
      </div>

      {{-- Titre + image vignette à droite --}}
      <div class="flex flex-col lg:flex-row justify-between items-start gap-6">
        <div class="flex-1">
          <time datetime="{{ $event->start_date->toDateString() }}" class="block text-sm text-gray-600 mb-2">
              {{ $event->start_date->translatedFormat('d F Y') }}
          </time>

          <h1 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl hover:text-teal-600 transition">
              {{ $event->title }}
          </h1>
        </div>

        @if($event->cover_image)
        <div class="w-[580px] hidden lg:block">
          <img 
            src="{{ asset('storage/' . $event->cover_image) }}" 
            alt="Image de l'événement"
            class="w-full h-auto rounded-xl shadow-md object-cover"
          >
        </div>
        @endif
      </div>

      {{-- Description de l'événement --}}
      <div class="mt-10 text-gray-700 prose prose-lg prose-teal w-full max-w-none">
        <p><strong class="text-teal-700">Lieu :</strong> {{ $event->location }}</p>
        <p><strong class="text-teal-700">Date début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</p>
        <p><strong class="text-teal-700">Date fin :</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
        <p><strong class="text-teal-700">Description :</strong> {{ $event->description }}</p>
      </div>

    </div>
  </div>
</section>

<style>
  .prose h2,
  .prose h3 {
    font-weight: 700;
  }
</style>
