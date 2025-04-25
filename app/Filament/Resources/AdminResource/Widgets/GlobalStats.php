<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GlobalStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Utilisateurs', User::count())
                ->description('Nombre total d\'utilisateurs')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('Produits', Product::count())
                ->description('Nombre total de produits')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary'),

            Stat::make('Événements', Event::count())
                ->description('Nombre total d\'événements')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('warning'),
        ];
    }
}
