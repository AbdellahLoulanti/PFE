<section class="min-h-screen bg-gradient-to-br from-teal-100 via-white to-teal-50 flex flex-col">
    <div class="relative flex-1 max-w-6xl mx-auto w-full px-8 py-16 flex flex-col md:flex-row items-center md:items-start gap-16">

        <!-- Contenu textuel à gauche -->
        <div class="w-full md:w-1/2 flex flex-col text-teal-900">
            <h1 class="text-5xl font-extrabold mb-6 tracking-wide leading-tight drop-shadow-md">
                {{ $event->title }}
            </h1>

            <div class="space-y-8 text-lg font-light leading-relaxed drop-shadow-sm">
                <p><strong class="font-semibold text-teal-700"></strong> {{ $event->description }}</p>

                <p class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0L6.343 16.414m0 0L3 20m3.343-3.586L9 21m4-13a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span><strong class="text-teal-700">Lieu :</strong> {{ $event->location }}</span>
                </p>

                <p class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z" />
                    </svg>
                    <span><strong class="text-teal-700">Date début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</span>
                </p>

                <p class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7V3m-8 4V3m9 8H7m6 5a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span><strong class="text-teal-700">Date fin :</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</span>
                </p>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-12 flex gap-6">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-full bg-teal-700 text-white font-semibold hover:bg-teal-800 shadow-lg transition">
                    ← Retour aux événements
                </a>
            </div>
        </div>

        <!-- Image cover avec overlay et effet zoom au hover -->
        <div class="relative w-full md:w-1/2 rounded-3xl overflow-hidden shadow-2xl transform transition-transform duration-500 hover:scale-105">
            <img
                src="{{ asset('storage/' . $event->cover_image) }}"
                alt="Image de l'événement"
                class="w-full h-[480px] object-cover brightness-90"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
        </div>
    </div>
</section>
