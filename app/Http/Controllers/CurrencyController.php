<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = ["AUD", "BGN", "BRL", "CAD", "CHF", "CNY", "CZK", "DKK", "EUR", "GBP", "HKD",
            "HRK", "HUF", "IDR", "ILS", "INR", "ISK", "JPY", "KRW", "MXN", "MYR", "NOK",
            "NZD", "PHP", "PLN", "RON", "RUB", "SEK", "SGD", "THB", "TRY", "USD", "ZAR"];
        return view('index', compact(['currencies']));
    }

    public function currency(Request $request) {
        $validator = Validator::make($request->all(), [
            'amount' => 'numeric|min:0',
        ]);

        if (!$validator->fails()) {
            try {
//                $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
//                    'apikey' => env('API_KEY),
//                    'base_currency' => $request->base_currency
//                ]);
//
//                $cur = $response->json('data')[$request->currency] ?? 0;

                // Cache anahtarını oluşturuyoruz, böylece her farklı döviz için ayrı cache tutulur.
                $cacheKey = 'currency_' . $request->base_currency . '_' . $request->currency;

                // Cache'de var mı kontrol edelim, eğer yoksa API'ye istek atıp cache'e ekleyelim
                $cur = Cache::remember($cacheKey, 10 * 60, function () use ($request) {
                    $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
                        'apikey' => env('API_KEY'),
                        'base_currency' => $request->base_currency
                    ]);
                    return $response->json('data')[$request->currency] ?? 0;
                });

                $total = number_format($request->amount * $cur, 2);
            } catch (\Exception $e) {
                $total = 0;
            }

            return response()->json($total);
        } else {
            return response()->json("");
        }
    }

    public function instant()
    {
        try {
//            $response_usd = Http::get('https://api.freecurrencyapi.com/v1/latest', [
//                'apikey' => env('API_KEY),
//                'base_currency' => 'USD',
//                'currencies' => 'TRY'
//            ]);
//            $response_euro = Http::get('https://api.freecurrencyapi.com/v1/latest', [
//                'apikey' => env('API_KEY),
//                'base_currency' => 'EUR',
//                'currencies' => 'TRY'
//            ]);
//            $response_pln = Http::get('https://api.freecurrencyapi.com/v1/latest', [
//                'apikey' => env('API_KEY),
//                'base_currency' => 'PLN',
//                'currencies' => 'TRY'
//            ]);
//
//            $usd = number_format($response_usd->json('data')['TRY'] ?? 0, 4);
//            $euro = number_format($response_euro->json('data')['TRY'] ?? 0, 4);
//            $pln = number_format($response_pln->json('data')['TRY'] ?? 0, 4);

            $usd = Cache::remember('usd_try', 10 * 60, function () {
                $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
                    'apikey' => env('API_KEY'),
                    'base_currency' => 'USD',
                    'currencies' => 'TRY'
                ]);
                return number_format($response->json('data')['TRY'] ?? 0, 4);
            });

            $euro = Cache::remember('euro_try', 10 * 60, function () {
                $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
                    'apikey' => env('API_KEY'),
                    'base_currency' => 'EUR',
                    'currencies' => 'TRY'
                ]);
                return number_format($response->json('data')['TRY'] ?? 0, 4);
            });

            $pln = Cache::remember('pln_try', 10 * 60, function () {
                $response = Http::get('https://api.freecurrencyapi.com/v1/latest', [
                    'apikey' => env('API_KEY'),
                    'base_currency' => 'PLN',
                    'currencies' => 'TRY'
                ]);
                return number_format($response->json('data')['TRY'] ?? 0, 4);
            });


        } catch (\Exception $e) {
            $usd = $euro = $pln = 0.0000;
        }

        return response()->json(['usd' => $usd, 'euro' => $euro, 'pln' => $pln]);
    }

}
