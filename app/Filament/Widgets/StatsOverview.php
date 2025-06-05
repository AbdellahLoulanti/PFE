<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\OrderItem;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getCards(): array
    {
        return [
            Card::make('Events', Event::count())
                ->description('Total Events')
                ->icon('heroicon-o-calendar-days')
                ->color('success')
                ->chart([180, 220, 260, 200, 270]),

            Card::make('Blog Posts', BlogPost::count())
                ->description('Total Posts')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->chart([20, 30, 40, 35, 45]),

            Card::make('Total Revenue', number_format(OrderItem::sum(\DB::raw('price * quantity')), 0, '.', ',').' MAD')
                ->description('Revenue Generated')
                ->icon('heroicon-o-currency-dollar')
                ->color('success')
                ->chart([400, 600, 900, 750, 1000]),

            Card::make('Users', User::count())
                ->description('Registered Users')
                ->icon('heroicon-o-user')
                ->color('warning')
                ->chart([100, 120, 130, 140, 160]),
        ];
    }
}
