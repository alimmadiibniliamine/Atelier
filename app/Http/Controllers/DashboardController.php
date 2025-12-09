<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', $this->buildStats());
    }

    public function stats()
    {
        return response()->json($this->buildStats());
    }

    private function buildStats(): array
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();

        // ✅ Visiteurs actuellement présents
        $currentVisitors = Visite::where('statut', 'EN_COURS')->count();

        // ✅ Visites aujourd’hui
        $visitsToday = Visite::whereDate('arrivee_at', $today)->count();

        // ✅ Visites cette semaine
        $visitsWeek = Visite::whereBetween('arrivee_at', [$startOfWeek, now()])->count();

        // ✅ Conversion (visites terminées / total)
        $total = Visite::count();
        $finished = Visite::where('statut', 'TERMINEE')->count();
        $conversionRate = $total > 0 ? ($finished / $total) * 100 : 0;

        // ✅ Visites par jour (7 jours)
        $weeklyVisits = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $weeklyVisits[] = Visite::whereDate('arrivee_at', $date)->count();
        }

        // ✅ Visites par mois (6 mois)
        $monthlyVisits = [];
        $monthLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyVisits[] = Visite::whereYear('arrivee_at', $date->year)
                ->whereMonth('arrivee_at', $date->month)
                ->count();

            $monthLabels[] = $date->translatedFormat('M');
        }

        return [
            'currentVisitors' => $currentVisitors,
            'visitsToday'     => $visitsToday,
            'visitsWeek'      => $visitsWeek,
            'conversionRate' => round($conversionRate, 1),

            'weeklyVisits'    => $weeklyVisits,
            'monthlyVisits'  => $monthlyVisits,
            'monthLabels'     => $monthLabels,

            // ✅ Pour l’instant on met à 0 (tu pourras faire comparaison J-1 après)
            'currentVisitorsChange' => 0,
            'visitsTodayChange'     => 0,
            'visitsWeekChange'      => 0,
            'conversionChange'      => 0,
            'monthlyChange'         => 0,
        ];
    }
}
