<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class EventsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Événements par mois';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $counts = [];

        foreach ($data as $entry) {
            $months[] = Carbon::create()->month($entry->month)->locale('fr')->isoFormat('MMMM');
            $counts[] = $entry->count;
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Événements',
                    'data' => $counts,
                    'fill' => true,
                    'borderColor' => '#14b8a6',
                    'backgroundColor' => 'rgba(20, 184, 166, 0.3)',
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
