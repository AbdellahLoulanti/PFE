<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Event;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('👤 Utilisateurs', User::count())
                ->description('Total des utilisateurs enregistrés')
                ->color('primary')
                ->extraAttributes(['class' => 'hover:scale-105 transition-transform duration-300'])
                ->icon('heroicon-o-user-group'),

            Card::make('📅 Événements publics', Event::public()->count())
                ->description('Visibles au public')
                ->color('success')
                ->icon('heroicon-o-calendar')
                ->extraAttributes(['class' => 'hover:scale-105 transition-transform duration-300']),

            Card::make('📝 Blogs publiés', BlogPost::where('status', 'published')->count())
                ->description('Articles actifs')
                ->color('info')
                ->icon('heroicon-o-newspaper')
                ->extraAttributes(['class' => 'hover:scale-105 transition-transform duration-300']),

            Card::make('🛒 Produits', Product::count())
                ->description('Total des produits')
                ->color('warning')
                ->icon('heroicon-o-shopping-cart')
                ->extraAttributes(['class' => 'hover:scale-105 transition-transform duration-300']),

            Card::make('📬 Messages', ContactMessage::count())
                ->description('Reçus via Contact')
                ->color('danger')
                ->icon('heroicon-o-inbox')
                ->extraAttributes(['class' => 'hover:scale-105 transition-transform duration-300']),
        ];
    }
}
