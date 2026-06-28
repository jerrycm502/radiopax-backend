<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\WeeklySchedule;
use App\Models\DailyGospel;
use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the listener homepage.
     */
    public function index()
    {
        // 1. Fetch latest news (up to 6 items)
        $news = News::orderBy('published_at', 'desc')->take(6)->get();

        // 2. Fetch today's Daily Gospel (fallback to the latest if today's is not posted yet)
        $today = Carbon::today()->toDateString();
        $gospel = DailyGospel::where('date', $today)->first();
        if (!$gospel) {
            $gospel = DailyGospel::orderBy('date', 'desc')->first();
        }

        // 3. Fetch weekly schedule grouped by day
        // We'll structure days as: 1 = Lunes, 2 = Martes, ..., 7 = Domingo
        $schedules = WeeklySchedule::orderBy('start_time', 'asc')->get();

        // 4. Fetch active sponsors
        $sponsors = Sponsor::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('index', compact('news', 'gospel', 'schedules', 'sponsors'));
    }
}
