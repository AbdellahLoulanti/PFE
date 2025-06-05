<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\OrderItem;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StatsG extends ChartWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Activité de la plateforme';

    protected static ?string $maxHeight = '360px';

    protected function getData(): array
    {
        $currentYear = now()->year;

        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->locale('fr')->isoFormat('MMM');
        })->toArray();

        $events = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $blogs = BlogPost::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $currentYear = now()->year;
        $revenues = OrderItem::selectRaw('MONTH(created_at) as month, SUM(price * quantity) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        $eventData = [];
        $blogData = [];
        $revenueData = [];

        for ($i = 1; $i <= 12; $i++) {
            $eventData[] = $events[$i] ?? 0;
            $blogData[] = $blogs[$i] ?? 0;
            $revenueData[] = round($revenues[$i] ?? 0, 2);
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Événements créés',
                    'data' => $eventData,
                    'borderColor' => '#06b6d4',
                    'backgroundColor' => 'rgba(6, 182, 212, 0.2)',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Articles publiés',
                    'data' => $blogData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Revenus estimés (MAD)',
                    'data' => $revenueData,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'tension' => 0.4,
                    'yAxisID' => 'y1',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): ?array
    {
        return [
            'responsive' => true,
            'scales' => [
                'y' => [
                    'title' => ['display' => true, 'text' => 'Nombre'],
                ],
                'y1' => [
                    'type' => 'linear',
                    'position' => 'right',
                    'grid' => ['drawOnChartArea' => false],
                    'title' => ['display' => true, 'text' => 'Revenus (MAD)'],
                ],
            ],
        ];
    }
}
