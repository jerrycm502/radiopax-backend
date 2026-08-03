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

    /**
     * Handle the checkout redirection with Recurrente.
     */
    public function donationCheckout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5',
            'frequency' => 'required|in:one-time,monthly',
        ]);

        $amount = (float) $request->input('amount');
        $amountInCents = (int) round($amount * 100);
        $frequency = $request->input('frequency');

        $secretKey = env('RECURRENTE_SECRET_KEY');

        if (!$secretKey) {
            return back()->with('error', 'La pasarela de pago no está configurada (llave API faltante).');
        }

        $itemName = $frequency === 'monthly' ? 'Donación Mensual - Radio Pax' : 'Donación Única - Radio Pax';
        
        $item = [
            'name' => $itemName,
            'amount_in_cents' => $amountInCents,
            'currency' => 'GTQ',
            'quantity' => 1,
        ];

        if ($frequency === 'monthly') {
            $item['charge_type'] = 'recurring';
            $item['billing_interval'] = 'month';
            $item['billing_interval_count'] = 1;
        }

        // Call Recurrente API
        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'X-SECRET-KEY' => $secretKey,
                'Content-Type' => 'application/json',
            ])->post('https://app.recurrente.com/api/checkouts', [
                'items' => [$item],
                'success_url' => route('home', ['status' => 'donation_success']),
                'cancel_url' => route('home', ['status' => 'donation_cancelled']),
            ]);

            if ($response->successful()) {
                $checkoutUrl = $response->json('checkout_url');
                if ($checkoutUrl) {
                    return redirect()->away($checkoutUrl);
                }
            }

            $errorMsg = $response->json('error') ?? 'Error al comunicarse con la pasarela de pagos.';
            return back()->with('error', $errorMsg);

        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo iniciar el proceso de donación: ' . $e->getMessage());
        }
    }
}
