<div class="max-w-7xl mx-auto  px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-teal-700 mb-10 text-center">Offres d’emploi</h1>

    @forelse ($groupedJobs as $type => $jobs)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b border-teal-500 inline-block pb-1">
                {{ strtoupper($type) }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition border border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-teal-600 font-medium">{{ $job->type }}</span>
                            <span class="text-xs text-gray-500">{{ $job->published_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $job->post }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $job->location }}</p>

                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit($job->description, 100) }}</p>

                        <a href="{{ route('jobs.show', $job) }}"
                         class="text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 px-4 py-2 rounded-full transition">
                            Voir plus
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 text-lg">Aucune offre d'emploi disponible.</p>
    @endforelse
</div>
