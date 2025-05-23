<div class="max-w-7xl mx-auto px-6 py-8 -mt-[80px]">
    <h2 class="text-4xl font-bold mb-10 text-center text-gray-800">Tous les événements</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        @foreach($events as $event)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="{{ $event->cover_image_url }}" alt="Event Image" class="h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2 text-teal-700">{{ $event->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                    <p class="text-sm text-gray-500">📍 {{ $event->location }}</p>
                    <p class="text-sm text-gray-500">🗓 {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="inline-block mt-4 text-teal-600 hover:underline font-medium text-sm">Voir plus →</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
