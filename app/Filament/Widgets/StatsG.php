<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class StatsG extends ChartWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Dashboard Activity';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->locale('en')->isoFormat('MMM');
        })->toArray();

        $events = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')->pluck('count', 'month');

        $blogs = BlogPost::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')->pluck('count', 'month');

        $revenues = Product::selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->groupBy('month')->pluck('total', 'month');

        $eventData = [];
        $blogData = [];
        $revenueData = [];

        for ($i = 1; $i <= 12; $i++) {
            $eventData[] = $events[$i] ?? 0;
            $blogData[] = $blogs[$i] ?? 0;
            $revenueData[] = $revenues[$i] ?? 0;
        }

        return [
            'labels' => $months,
            'datasets' => [
                [
                    'label' => 'Events',
                    'data' => $eventData,
                    'borderColor' => '#06b6d4',
                    'backgroundColor' => 'rgba(6, 182, 212, 0.2)',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Blog Posts',
                    'data' => $blogData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Revenue (MAD)',
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
            'scales' => [
                'y1' => [
                    'type' => 'linear',
                    'position' => 'right',
                    'grid' => ['drawOnChartArea' => false],
                    'title' => ['display' => true, 'text' => 'Revenue (MAD)'],
                ],
            ],
        ];
    }
}
