<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Associative ENSA Tétouan</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
   <!-- Navbar -->
<nav class="bg-gray-900 text-white p-4">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Plateforme Associative ENSA</h1>
        <div>
            <a href="{{ route('login') }}" class="px-4 py-2 bg-white text-blue-600 rounded-md font-semibold hover:bg-gray-200">Se connecter</a>
            <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-yellow-400 text-white rounded-md font-semibold hover:bg-yellow-500">S'inscrire</a>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <header class="text-center py-20 bg-blue-500 text-white">
        <h2 class="text-4xl font-extrabold">Bienvenue sur la plateforme associative ENSA Tétouan</h2>
        <p class="mt-4 text-lg">Gérez vos événements, articles de blog et communication avec vos membres.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-block px-6 py-3 bg-yellow-400 text-white rounded-lg text-lg font-semibold hover:bg-yellow-500">Rejoindre maintenant</a>
    </header>

    <!-- Sections -->
    <section class="max-w-6xl mx-auto py-12 px-6 grid md:grid-cols-3 gap-8">
        <!-- Blog -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-2xl font-bold">📖 Articles de Blog</h3>
            <p class="mt-2 text-gray-600">Publiez et partagez des articles avec votre communauté.</p>
        </div>

        <!-- Events -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-2xl font-bold">📅 Événements</h3>
            <p class="mt-2 text-gray-600">Organisez et annoncez vos événements associatifs.</p>
        </div>

        <!-- Communication -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-2xl font-bold">📢 Communication</h3>
            <p class="mt-2 text-gray-600">Envoyez des newsletters et gardez le contact avec vos membres.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-4">
        <p>&copy; 2024 ENSA Tétouan - Tous droits réservés.</p>
    </footer>

</body>
</html>
