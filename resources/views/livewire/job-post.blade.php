<section class="min-h-screen bg-gray-50 px-6">
    <div class="max-w-5xl mx-auto">
        <!-- Retour -->
        <a href="{{ route('jobs') }}" class="text-sm text-gray-500 hover:text-teal-600 transition mb-6 inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Retour aux offres
        </a>

        <!-- Carte principale -->
        <div class="bg-white shadow-2xl rounded-3xl p-10 border border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-4xl font-extrabold text-teal-700">{{ $job->post }}</h1>
                    <p class="text-gray-600 text-sm mt-1">{{ $job->location }} • {{ $job->type }}</p>
                </div>
                <span class="text-xs text-gray-400 mt-2 md:mt-0">
                    Publié le {{ $job->published_at->format('d M Y') }}
                </span>
            </div>

            <!-- Description -->
            <div class="border-t border-gray-100 pt-6 text-gray-800 leading-relaxed text-[15px] space-y-4">
                {!! nl2br(e($job->description)) !!}
            </div>

            <!-- Call to action -->
            <div class="mt-10">
               <a href="https://mail.google.com/mail/?view=cm&fs=1&to=abdellahloulanti234@gmail.com&su=Candidature%20pour%20le%20poste%20de%20{{ urlencode($job->post) }}"
   target="_blank"
   class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-full font-semibold transition">
    Postuler maintenant via Gmail
</a>



            </div>
        </div>
    </div>
</section>
