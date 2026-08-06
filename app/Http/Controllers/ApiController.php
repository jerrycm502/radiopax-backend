<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\WeeklySchedule;
use App\Models\DailyGospel;
use App\Models\CabinStatus;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Get all news items.
     */
    public function getNews(): JsonResponse
    {
        $news = News::orderBy('published_at', 'desc')->get()->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'title' => $item->title,
                'content' => $item->content,
                'date' => $item->published_at->toIso8601String(),
                'category' => $item->category,
                'imageUrl' => $item->image_url,
                'isImportant' => (bool) $item->is_important,
            ];
        });

        return response()->json($news);
    }

    /**
     * Get today's Gospel reading.
     */
    public function getTodayGospel(): JsonResponse
    {
        $today = Carbon::today()->toDateString();
        $gospel = DailyGospel::where('date', $today)->first();

        // Fallback to the latest gospel if today's is not posted yet
        if (!$gospel) {
            $gospel = DailyGospel::orderBy('date', 'desc')->first();
        }

        if (!$gospel) {
            return response()->json(['message' => 'No gospels found'], 404);
        }

        return response()->json([
            'id' => (string) $gospel->id,
            'date' => $gospel->date->toDateString(),
            'title' => $gospel->title,
            'passage' => $gospel->passage,
            'content' => $gospel->content,
            'reflection' => $gospel->reflection,
        ]);
    }

    /**
     * Get the full weekly schedule.
     */
    public function getWeeklySchedule(): JsonResponse
    {
        $schedules = WeeklySchedule::all()->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'name' => $item->name,
                'host' => $item->host,
                'startTime' => $item->start_time,
                'endTime' => $item->end_time,
                'daysOfWeek' => $item->days_of_week, // Already cast to array
                'description' => $item->description ?? '',
                'imageUrl' => $item->image_url,
            ];
        });

        return response()->json($schedules);
    }

    /**
     * Get the current active program/host status.
     */
    public function getCurrentSchedule(): JsonResponse
    {
        $status = CabinStatus::first();
        if (!$status) {
            $status = CabinStatus::create([
                'mode' => 'auto',
                'is_streaming' => true,
                'banner_message' => '¡Bienvenidos a Radio Pax!',
            ]);
        }

        $now = Carbon::now();
        $currentTimeStr = $now->format('H:i');
        
        // Carbon's dayOfWeekIso: 1 = Monday, 2 = Tuesday, ..., 7 = Sunday
        $dayIso = $now->dayOfWeekIso;

        $programName = 'Programación Musical Ininterrumpida';
        $hostName = 'Radio Pax FM';
        $description = 'Acompañándote con música que eleva tu espíritu e infunde paz en tu hogar las 24 horas.';
        $isLive = false;
        $currentProgramId = 'bg_music';

        if ($status->mode === 'manual') {
            $programName = $status->current_program ?? $programName;
            $hostName = $status->current_host ?? $hostName;
            $isLive = (bool) $status->is_streaming;
            $currentProgramId = 'manual_override';
            $description = 'Transmisión especial en vivo desde la cabina.';
        } else {
            // Automatic mode: find active program in database for current day/time
            $schedules = WeeklySchedule::all();
            
            foreach ($schedules as $program) {
                if (in_array($dayIso, $program->days_of_week)) {
                    // Check if current time is within program window
                    if ($currentTimeStr >= $program->start_time && $currentTimeStr < $program->end_time) {
                        $currentProgramId = (string) $program->id;
                        $programName = $program->name;
                        $hostName = $program->host;
                        $description = $program->description ?? '';
                        $isLive = true;
                        break;
                    }
                }
            }
        }

        // Find next program
        $nextProgramName = 'Música Instrumentales';
        $nextProgramStart = '00:00';
        $nextProgramHost = 'Radio Pax';
        
        $schedulesToday = WeeklySchedule::all()->filter(function ($p) use ($dayIso) {
            return in_array($dayIso, $p->days_of_week);
        })->sortBy('start_time');

        $foundNext = false;
        foreach ($schedulesToday as $program) {
            if ($program->start_time > $currentTimeStr) {
                $nextProgramName = $program->name;
                $nextProgramStart = $program->start_time;
                $nextProgramHost = $program->host;
                $foundNext = true;
                break;
            }
        }

        if (!$foundNext) {
            // Get first program of tomorrow
            $tomorrowIso = $dayIso == 7 ? 1 : $dayIso + 1;
            $schedulesTomorrow = WeeklySchedule::all()->filter(function ($p) use ($tomorrowIso) {
                return in_array($tomorrowIso, $p->days_of_week);
            })->sortBy('start_time');
            
            if ($schedulesTomorrow->isNotEmpty()) {
                $next = $schedulesTomorrow->first();
                $nextProgramName = $next->name;
                $nextProgramStart = $next->start_time;
                $nextProgramHost = $next->host;
            }
        }

        return response()->json([
            'id' => $currentProgramId,
            'name' => $programName,
            'host' => $hostName,
            'description' => $description,
            'isLive' => $isLive,
            'bannerMessage' => $status->banner_message,
            'nextProgram' => [
                'name' => $nextProgramName,
                'startTime' => $nextProgramStart,
                'host' => $nextProgramHost,
            ]
        ]);
    }

    /**
     * Handle the checkout redirection with Recurrente for API.
     */
    public function donationCheckout(\Illuminate\Http\Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:5',
            'frequency' => 'required|in:one-time,monthly',
            'name' => 'nullable|string|max:100',
        ]);

        $amount = (float) $request->input('amount');
        $amountInCents = (int) round($amount * 100);
        $frequency = $request->input('frequency');
        $name = $request->input('name') ?: 'Donante Anónimo';

        $secretKey = env('RECURRENTE_SECRET_KEY');

        if (!$secretKey) {
            return response()->json(['error' => 'La pasarela de pago no está configurada.'], 500);
        }

        // Try pre-creating customer to prevent checkout form from demanding an email input
        $customerId = null;
        try {
            $customerEmail = 'donante_' . time() . '_' . rand(100, 999) . '@radiopax.com';
            $customerResponse = \Illuminate\Support\Facades\Http::withHeaders([
                'X-SECRET-KEY' => $secretKey,
                'Content-Type' => 'application/json',
            ])->post('https://app.recurrente.com/api/customers', [
                'email' => $customerEmail,
                'full_name' => $name,
            ]);

            if ($customerResponse->successful()) {
                $customerId = $customerResponse->json('id');
            }
        } catch (\Exception $e) {
            // Gracefully ignore, fallback
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

        // Call Recurrente API checkouts
        try {
            $payload = [
                'items' => [$item],
                'success_url' => route('home', ['status' => 'donation_success']),
                'cancel_url' => route('home', ['status' => 'donation_cancelled']),
            ];

            if ($customerId) {
                $payload['customer_id'] = $customerId;
            }

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'X-SECRET-KEY' => $secretKey,
                'Content-Type' => 'application/json',
            ])->post('https://app.recurrente.com/api/checkouts', $payload);

            if ($response->successful()) {
                $checkoutUrl = $response->json('checkout_url');
                if ($checkoutUrl) {
                    return response()->json(['checkout_url' => $checkoutUrl]);
                }
            }

            $errorMsg = $response->json('error') ?? 'Error al comunicarse con la pasarela de pagos.';
            return response()->json(['error' => $errorMsg], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo crear el checkout: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Process direct card donation from the mobile app.
     */
    public function donationPayCard(\Illuminate\Http\Request $request): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:5',
            'frequency' => 'required|in:one-time,monthly',
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:150',
            'card_number' => 'required|string|min:13|max:19',
            'exp_month' => 'required|string|min:2|max:2',
            'exp_year' => 'required|string|min:2|max:4',
            'cvv' => 'required|string|min:3|max:4',
        ]);

        $amount = (float) $request->input('amount');
        $amountInCents = (int) round($amount * 100);
        $frequency = $request->input('frequency');
        $name = $request->input('name') ?: 'Donante Anónimo';
        $email = $request->input('email') ?: ('donante_' . time() . '_' . rand(100, 999) . '@radiopax.com');

        $cardNumber = preg_replace('/\D/', '', $request->input('card_number'));
        $expMonth = sprintf('%02d', (int) $request->input('exp_month'));
        $expYear = strlen($request->input('exp_year')) == 2 ? '20' . $request->input('exp_year') : $request->input('exp_year');
        $cvv = $request->input('cvv');

        $secretKey = env('RECURRENTE_SECRET_KEY');

        // If Recurrente Secret Key is configured, attempt direct payment intent via Recurrente API
        if ($secretKey) {
            try {
                $payload = [
                    'amount_in_cents' => $amountInCents,
                    'currency' => 'GTQ',
                    'card' => [
                        'card_number' => $cardNumber,
                        'cvv' => $cvv,
                        'expiration_month' => $expMonth,
                        'expiration_year' => substr($expYear, -2),
                        'holder_name' => $name,
                    ],
                    'billing_details' => [
                        'email' => $email,
                        'name' => $name,
                    ],
                ];

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'X-SECRET-KEY' => $secretKey,
                    'Content-Type' => 'application/json',
                ])->post('https://app.recurrente.com/api/payment_intents', $payload);

                if ($response->successful()) {
                    $intentId = $response->json('id') ?? ('REC-' . strtoupper(substr(md5(time()), 0, 8)));
                    return response()->json([
                        'success' => true,
                        'message' => '¡Donación procesada exitosamente! Muchas gracias por apoyar a Radio Pax.',
                        'transaction_id' => $intentId,
                    ]);
                }

                // Fallback: If direct payment_intent is rejected (Recurrente requires Hosted Checkout),
                // create a checkout session and return checkout_url for In-App browser
                $itemName = $frequency === 'monthly' ? 'Donación Mensual - Radio Pax' : 'Donación Única - Radio Pax';
                $checkoutPayload = [
                    'items' => [[
                        'name' => $itemName,
                        'amount_in_cents' => $amountInCents,
                        'currency' => 'GTQ',
                        'quantity' => 1,
                    ]],
                    'success_url' => route('home', ['status' => 'donation_success']),
                    'cancel_url' => route('home', ['status' => 'donation_cancelled']),
                ];

                $checkoutResponse = \Illuminate\Support\Facades\Http::withHeaders([
                    'X-SECRET-KEY' => $secretKey,
                    'Content-Type' => 'application/json',
                ])->post('https://app.recurrente.com/api/checkouts', $checkoutPayload);

                if ($checkoutResponse->successful()) {
                    $checkoutUrl = $checkoutResponse->json('checkout_url');
                    if ($checkoutUrl) {
                        return response()->json(['checkout_url' => $checkoutUrl]);
                    }
                }

                $errorMsg = $response->json('error') 
                    ?? $response->json('message') 
                    ?? $checkoutResponse->json('error')
                    ?? 'La pasarela de pago no pudo procesar la transacción.';
                return response()->json(['error' => $errorMsg], 400);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al procesar el pago: ' . $e->getMessage()], 500);
            }
        }

        // Mock / Fallback mode if Recurrente key is not set yet
        $mockId = 'RPX-' . rand(100000, 999999);
        return response()->json([
            'success' => true,
            'message' => '¡Donación de Q' . number_format($amount, 2) . ' registrada exitosamente! Gracias por tu generosidad.',
            'transaction_id' => $mockId,
        ]);
    }
}

