<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\WeeklySchedule;
use App\Models\DailyGospel;
use App\Models\CabinStatus;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the main admin dashboard.
     */
    public function dashboard()
    {
        $cabin = CabinStatus::first();
        if (!$cabin) {
            $cabin = CabinStatus::create([
                'mode' => 'auto',
                'is_streaming' => true,
                'banner_message' => '¡Bienvenidos a Radio Pax!',
            ]);
        }

        $newsCount = News::count();
        $scheduleCount = WeeklySchedule::count();
        $gospelCount = DailyGospel::count();
        $sponsorCount = Sponsor::count();

        return view('admin.dashboard', compact('cabin', 'newsCount', 'scheduleCount', 'gospelCount', 'sponsorCount'));
    }

    /**
     * Update the cabin/live status.
     */
    public function updateCabin(Request $request)
    {
        $cabin = CabinStatus::first() ?: new CabinStatus();
        
        $data = $request->validate([
            'mode' => 'required|in:auto,manual',
            'current_program' => 'nullable|string|max:100',
            'current_host' => 'nullable|string|max:100',
            'is_streaming' => 'sometimes|boolean',
            'banner_message' => 'nullable|string|max:255',
        ]);

        $data['is_streaming'] = $request->has('is_streaming');

        $cabin->fill($data);
        $cabin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Estado de cabina actualizado correctamente.');
    }

    // --- News CRUD ---

    public function newsIndex()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function newsCreate()
    {
        return view('admin.news.form', ['item' => new News()]);
    }

    public function newsStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'category' => 'required|in:Parroquial,Radio,Comunidad',
            'image_url' => 'nullable|url|max:255',
            'is_important' => 'sometimes|boolean',
            'published_at' => 'required|date',
        ]);

        $data['is_important'] = $request->has('is_important');

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Noticia creada correctamente.');
    }

    public function newsEdit(News $news)
    {
        return view('admin.news.form', ['item' => $news]);
    }

    public function newsUpdate(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'category' => 'required|in:Parroquial,Radio,Comunidad',
            'image_url' => 'nullable|url|max:255',
            'is_important' => 'sometimes|boolean',
            'published_at' => 'required|date',
        ]);

        $data['is_important'] = $request->has('is_important');

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Noticia actualizada correctamente.');
    }

    public function newsDestroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Noticia eliminada correctamente.');
    }

    // --- Daily Gospel CRUD ---

    public function gospelsIndex()
    {
        $gospels = DailyGospel::orderBy('date', 'desc')->paginate(10);
        return view('admin.gospels.index', compact('gospels'));
    }

    public function gospelsCreate()
    {
        return view('admin.gospels.form', ['item' => new DailyGospel()]);
    }

    public function gospelsStore(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date|unique:daily_gospels,date',
            'title' => 'required|string|max:200',
            'passage' => 'required|string|max:100',
            'content' => 'required|string',
            'reflection' => 'nullable|string',
        ]);

        DailyGospel::create($data);

        return redirect()->route('admin.gospels.index')->with('success', 'Evangelio creado correctamente.');
    }

    public function gospelsEdit(DailyGospel $gospel)
    {
        return view('admin.gospels.form', ['item' => $gospel]);
    }

    public function gospelsUpdate(Request $request, DailyGospel $gospel)
    {
        $data = $request->validate([
            'date' => 'required|date|unique:daily_gospels,date,' . $gospel->id,
            'title' => 'required|string|max:200',
            'passage' => 'required|string|max:100',
            'content' => 'required|string',
            'reflection' => 'nullable|string',
        ]);

        $gospel->update($data);

        return redirect()->route('admin.gospels.index')->with('success', 'Evangelio actualizado correctamente.');
    }

    public function gospelsDestroy(DailyGospel $gospel)
    {
        $gospel->delete();
        return redirect()->route('admin.gospels.index')->with('success', 'Evangelio eliminado correctamente.');
    }

    // --- Weekly Schedule CRUD ---

    public function schedulesIndex()
    {
        $schedules = WeeklySchedule::orderBy('start_time', 'asc')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function schedulesCreate()
    {
        return view('admin.schedules.form', ['item' => new WeeklySchedule()]);
    }

    public function schedulesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'host' => 'required|string|max:100',
            'start_time' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'end_time' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'integer|between:1,7',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
        ]);

        // Cast elements to integers
        $data['days_of_week'] = array_map('intval', $data['days_of_week']);

        WeeklySchedule::create($data);

        return redirect()->route('admin.schedules.index')->with('success', 'Programa creado correctamente.');
    }

    public function schedulesEdit(WeeklySchedule $schedule)
    {
        return view('admin.schedules.form', ['item' => $schedule]);
    }

    public function schedulesUpdate(Request $request, WeeklySchedule $schedule)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'host' => 'required|string|max:100',
            'start_time' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'end_time' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'integer|between:1,7',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
        ]);

        $data['days_of_week'] = array_map('intval', $data['days_of_week']);

        $schedule->update($data);

        return redirect()->route('admin.schedules.index')->with('success', 'Programa actualizado correctamente.');
    }

    public function schedulesDestroy(WeeklySchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Programa eliminado correctamente.');
    }

    // --- Sponsors CRUD ---

    public function sponsorsIndex()
    {
        $sponsors = Sponsor::orderBy('name', 'asc')->paginate(10);
        return view('admin.sponsors.index', compact('sponsors'));
    }

    public function sponsorsCreate()
    {
        return view('admin.sponsors.form', ['item' => new Sponsor()]);
    }

    public function sponsorsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'logo_url' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|url|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('sponsors', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }

        Sponsor::create($data);

        return redirect()->route('admin.sponsors.index')->with('success', 'Patrocinador creado correctamente.');
    }

    public function sponsorsEdit(Sponsor $sponsor)
    {
        return view('admin.sponsors.form', ['item' => $sponsor]);
    }

    public function sponsorsUpdate(Request $request, Sponsor $sponsor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'logo_url' => 'nullable|string|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|url|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo_file')) {
            $path = $request->file('logo_file')->store('sponsors', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }

        $sponsor->update($data);

        return redirect()->route('admin.sponsors.index')->with('success', 'Patrocinador actualizado correctamente.');
    }

    public function sponsorsDestroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('admin.sponsors.index')->with('success', 'Patrocinador eliminado correctamente.');
    }
}
