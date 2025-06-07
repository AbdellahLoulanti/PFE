<div>
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
                        <div class="bg-teal-50 p-6 rounded-xl shadow-lg transform transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                            <p class="text-xl font-semibold text-teal-700 mb-4"><strong>Lieu :</strong> {{ $event->location }}</p>
                            
                            <p class="text-xl font-semibold text-teal-700 mb-4">
                                <strong>Date début :</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                            </p>
                            
                            <p class="text-xl font-semibold text-teal-700 mb-4">
                                <strong>Date fin :</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                            </p>
                            
                            <div class="bg-teal-100 p-4 rounded-md mt-6 shadow-md hover:bg-teal-200 transition-all duration-300">
                                <p class="text-lg text-gray-800"><strong class="text-teal-700">Description :</strong> {{ $event->description }}</p>
                            </div>
                        </div>
                    </div>

                    <style>
                        /* Text Prose */
                        .prose {
                            line-height: 1.7;
                            font-size: 1.125rem;
                            font-weight: 400;
                        }

                        .prose-lg {
                            font-size: 1.25rem;
                        }

                        /* Custom Styling */
                        .prose p {
                            margin-bottom: 1.5rem;
                        }

                        .prose .text-teal-700 {
                            color: #4c9f9f; /* Teal */
                        }

                        .prose .text-gray-800 {
                            color: #2d3748;
                        }

                        .prose .text-gray-700 {
                            color: #4a5568;
                        }

                        .prose .text-xl {
                            font-size: 1.25rem;
                            font-weight: 600;
                        }

                        .prose .font-semibold {
                            font-weight: 600;
                        }

                        /* Hover Animations */
                        .prose .hover\:scale-105:hover {
                            transform: scale(1.05);
                        }

                        .prose .hover\:shadow-2xl:hover {
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
                        }

                        /* Hover on background */
                        .prose .hover\:bg-teal-200:hover {
                            background-color: #b2f5ea; /* Lighter teal on hover */
                        }
                    </style>


            </div>
        </div>
    </section>
</div>
