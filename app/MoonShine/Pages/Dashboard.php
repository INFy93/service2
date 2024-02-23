<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Order;
use MoonShine\Components\TableBuilder;
use MoonShine\Components\Title;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Pages\Page;

class Dashboard extends Page
{

    private function getCounts(): array
    {
        $orders = Order::select('status')->get();

        $total_count = $orders->count();
        $open_count = $orders->whereNotIn('status', [6, 7])->count();
        $at_work_count = $orders->where('status', 2)->count();

        return $counts = [
            'total' => $total_count,
            'open' => $open_count,
            'at_work' => $at_work_count,
        ];
    }

    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'Управление';
    }

    public function components(): array
	{
        $count = $this->getCounts();

		return [
            Grid::make([
                Column::make([
                    ValueMetric::make('Всего заказов')
                    ->value($count['total'])
                ])->columnSpan(4),
                Column::make([
                    ValueMetric::make('Открытые заказы')
                        ->value($count['open'])
                ])->columnSpan(4),
                Column::make([
                    ValueMetric::make('В работе')
                        ->value($count['at_work'])
                ])->columnSpan(4),
            ]),

        ];
	}
}
