<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Date;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show dashboard.
     *
     * @return Response
     */
    public function index(): Response
    {
        // create an array that only include date.date from dates
        $dates = Date::get()->pluck('date')->toArray();
        // for each date in dates get the month and put it in a new array. if a date is null do nothing
        $months = array_map(function ($date) {
            return !$date ? null : date('m', strtotime($date));
        }, $dates);



        return Inertia::render('Dashboard', [
            "dates" => $months,
        ]);
    }

    /**
     * Get chart data.
     *
     * @return array
     */
    public function getChartData(): array
    {
        $months = collect();
        $startMonth = \Jenssegers\Date\Date::now()->subMonths(6)->startOfMonth();
        $monthsCount = 12;

        for ($i = 0; $i < $monthsCount; $i++) {
            $months->push($startMonth->clone()->addMonths($i));
        }

        $labels = [];
        $data = [];

        $stats = collect(
            Date::query()
                ->selectRaw('COUNT(*) as count, MONTH(date) as month, YEAR(date) as year')
                ->whereNotNull('date')
                ->whereBetween('date', [
                    $months[0],
                    $months[count($months) - 1]->clone()->endOfMonth(),
                ])
                ->groupBy('month', 'year')
                ->get()
                ->toArray()
        );

        foreach ($months as $month) {

            $monthStats = $stats
                ->where('month', $month->month)
                ->where('year', $month->year)
                ->first();

            $labels[] = $month->format('F (Y)');
            $data[] = $monthStats['count'] ?? 0;

            // SELECT MONTH(date) as month, COUNT(*) as count FROM dates GROUP BY month
        }

        $datasets = [
            [
                'label' => 'My First dataset',
                'backgroundColor' => 'red',
                'data' => $data,
                'borderColor' => 'pink',
                'fill'=> false,
                  'cubicInterpolationMode'=> 'monotone',
                  'tension'=> 0.4

            ]
        ];

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
}
