 @extends('components.layouts.app.layout')
 @section('title', 'Accueil')

 @section('content')
   <flux:main>
        {{ $slot }}
    </flux:main>
@endsection
