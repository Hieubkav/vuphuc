<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.admin.pages.dashboard';

    public function getColumns(): int | string | array
    {
        return [
            'sm' => 1,   // Mobile: 1 cột
            'md' => 2,   // Tablet: 2 cột
            'lg' => 3,   // Desktop: 3 cột
            'xl' => 4,   // Large: 4 cột
            '2xl' => 6,  // Extra large: 6 cột
        ];
    }

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Bộ lọc thống kê')
                    ->schema([
                        Select::make('period')
                            ->label('Khoảng thời gian')
                            ->options([
                                'today' => 'Hôm nay',
                                'yesterday' => 'Hôm qua',
                                'this_week' => 'Tuần này',
                                'this_month' => 'Tháng này',
                                'this_year' => 'Năm nay',
                                'last_year' => 'Năm ngoái',
                            ])
                            ->default('this_month')
                            ->selectablePlaceholder(false)
                            ->live()
                            ->afterStateUpdated(function () {
                                $this->dispatch('filtersUpdated');
                                $this->dispatch('$refresh');
                            }),
                    ])
                    ->columns(1),
            ]);
    }

    public function getWidgets(): array
    {
        return [
            // 0. Bảng điều khiển tracking (hàng đầu, full width)
            \App\Filament\Admin\Widgets\TrackingControlWidget::class,

            // 1. Thống kê KPI chính (hàng thứ 2, full width)
            \App\Filament\Admin\Widgets\DashboardKPIStats::class,

            // 2. Thống kê lượt truy cập website (hàng thứ 3, full width)
            \App\Filament\Admin\Widgets\VisitorStatsWidget::class,

            // 3. Biểu đồ trạng thái đơn hàng (hàng thứ 4, nửa width)
            \App\Filament\Admin\Widgets\OrderStatusChart::class,

            // 4. Biểu đồ doanh thu theo thời gian (hàng thứ 5, full width)
            \App\Filament\Admin\Widgets\RevenueChart::class,

            // 5. Top nội dung được xem nhiều nhất (hàng thứ 6, full width)
            \App\Filament\Admin\Widgets\TopContentWidget::class,
        ];
    }

    public function updatedFilters(): void
    {
        // Trigger refresh của tất cả widgets khi filter thay đổi
        $this->dispatch('filtersUpdated');
    }


}
