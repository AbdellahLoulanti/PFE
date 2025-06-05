<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'MyProject')</title>
  @vite(['resources/css/app.css'])
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
<script type="module">
  import { createIcons } from 'https://unpkg.com/lucide@latest?module';
  createIcons();
</script>
</head>
<body>

    <header class="fixed top-0 w-full bg-white text-[#0A2540] shadow-lg rounded-b-xl z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

          <!-- Logo -->
         <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/nb.png') }}" alt="Logo" class="h-11 w-auto scale-176">
            <span class="text-xl font-semibold text-[#064d4d] ml-[10px]">Publix</span>
        </a>


          <!-- Menu desktop -->
          <nav class="hidden md:flex gap-8 text-sm items-center">
            <a href="{{ route('home') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
                <i data-lucide="home" class="w-4 h-4"></i> Home
              </a>
            <a href="{{ route('blogs') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
              <i data-lucide="newspaper" class="w-4 h-4"></i> Blogs
            </a>
            <a href="{{ route('events') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
              <i data-lucide="calendar-days" class="w-4 h-4"></i> Évènements
            </a>
           <a href="{{ route('jobs') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
            <i data-lucide="briefcase" class="w-4 h-4"></i> Offres d’emploi
           </a>
            <a href="{{route('products')}}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
              <i data-lucide="shopping-bag" class="w-4 h-4"></i> Produits
            </a>
            <a href="{{route('about-us')}}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
              <i data-lucide="info" class="w-4 h-4"></i> À propos
            </a>
            <a href="{{ route('contact') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
              <i data-lucide="mail" class="w-4 h-4"></i> Contact
            </a>
          </nav>

       <div class="hidden md:block">
    @auth
        @if(auth()->user()->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel()))
            <!-- ADMIN connecté -->
            <a href="{{ route('filament.admin.pages.dashboard') }}"
               class="px-5 py-2 bg-[#008080] hover:bg-teal-700 transition rounded-lg text-white text-sm font-semibold flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard Admin
            </a>
        @else
            <!-- Utilisateur connecté mais pas admin -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-5 py-2 bg-[#008080] hover:bg-teal-700 transition rounded-lg text-white text-sm font-semibold flex items-center gap-2">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Se déconnecter
                </button>
            </form>
        @endif
    @else
        <!-- Visiteur non connecté -->
        <a href="{{ route('login') }}"
           class="px-5 py-2 bg-[#008080] hover:bg-teal-700 transition rounded-lg text-white text-sm font-semibold flex items-center gap-2">
            <i data-lucide="log-in" class="w-4 h-4"></i> Se connecter
        </a>
    @endauth
</div>




          <!-- Menu mobile -->
          <div class="md:hidden">
            <button @click="open = !open" class="text-[#0A2540] focus:outline-none transition-transform duration-200"
                    :class="{ 'rotate-90': open }">
              <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
              <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>

            <!-- Menu mobile déroulant -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-4 top-16 w-64 bg-white border rounded-lg shadow-lg py-4 px-6 space-y-3 text-sm text-[#0A2540] z-50">
                 <a href="{{ route('home') }}" class="font-bold hover:text-[#008080] transition flex items-center gap-2">
                    <i data-lucide="home" class="w-4 h-4"></i> Home
                  </a>
              <a href="{{ route('blogs') }}" class="block hover:text-[#008080] flex items-center gap-2">
                <i data-lucide="newspaper" class="w-4 h-4"></i> Blogs
              </a>
              <a href="{{ route('events') }}" class="block hover:text-[#008080] flex items-center gap-2">
                <i data-lucide="calendar-days" class="w-4 h-4"></i> Évènements
              </a>
              <a href="{{ route('products') }}" class="block hover:text-[#008080] flex items-center gap-2">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Produits
              </a>
              <a href="{{route('about-us')}}" class="block hover:text-[#008080] flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4"></i> À propos
              </a>
              <a href="{{ route('contact') }}" class="block hover:text-[#008080] flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4"></i> Contact
              </a>
              <hr>
  @auth
        @if(auth()->user()->canAccessPanel(\Filament\Facades\Filament::getCurrentPanel()))
            <a href="{{ route('filament.admin.pages.dashboard') }}"
               class="block w-full text-white bg-[#008080] hover:bg-teal-700 text-center rounded-lg py-2">
                Dashboard Admin
            </a>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-white bg-[#008080] hover:bg-teal-700 rounded-lg py-2">
                    Se déconnecter
                </button>
            </form>
        @endif
    @else
       <a href="{{ route('login') }}"
   class="block w-full text-white bg-[#008080] hover:bg-teal-700 text-center rounded-lg py-2 transition duration-200">
    Se connecter
</a>

    @endauth
            </div>
          </div>
        </div>
      </header>

  <!-- Contenu -->
  <main class="pt-28 pb-16 px-4 sm:px-6 lg:px-8 min-h-screen bg-gray">
    @yield('content')
  </main>

  <!-- Footer -->
<footer class="bg-teal-700 text-gray-100 pt-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 text-sm">
      <!-- Logo & Description -->
      <div>
        <h2 class="text-xl font-bold text-white mb-4">Publix</h2>
        <p class="text-gray-200 leading-relaxed">
          Des solutions numériques innovantes, conçues avec passion et expertise.
        </p>
      </div>

      <!-- Navigation -->
      <div>
        <h4 class="text-lg font-semibold text-white mb-4">Liens rapides</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('home') }}" class="hover:text-teal-300 transition">Accueil</a></li>
          <li><a href="{{ route('products') }}" class="hover:text-teal-300 transition">Produits</a></li>
          <li><a href="{{ route('events') }}" class="hover:text-teal-300 transition">Évènements</a></li>
          <li><a href="{{ route('about-us') }}" class="hover:text-teal-300 transition">À propos</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-teal-300 transition">Contact</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h4 class="text-lg font-semibold text-white mb-4">Contact</h4>
        <p>Email : <a href="mailto:support@myproject.com" class="text-teal-300 hover:underline">support@myproject.com</a></p>
        <p>Tél : +212 6 00 00 00 00</p>
        <div class="flex mt-4 space-x-4">
          <a href="#" class="hover:text-teal-300 transition" aria-label="Facebook">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12..." /></svg>
          </a>
          <a href="#" class="hover:text-teal-300 transition" aria-label="Twitter">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2..." /></svg>
          </a>
          <a href="#" class="hover:text-teal-300 transition" aria-label="LinkedIn">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="..." /></svg>
          </a>
        </div>
      </div>
    </div>

    <div class="text-center text-xs text-gray-300 py-6 border-t border-teal-600 mt-8">
      © {{ date('Y') }} MyProject. Tous droits réservés.
    </div>
  </footer>

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
  });
</script>

</body>
</html>
