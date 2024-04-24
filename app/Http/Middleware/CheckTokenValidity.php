<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class CheckTokenValidity
{
    public function handle(Request $request, Closure $next)
    {

        if ($request->session()->has('api_token')) {
            if (now()->diffInMinutes($request->session()->get('token_creation_time')) < 40) {
                return $next($request);
            }
        }

        $response = Http::get('https://frontend-test-assignment-api.abz.agency/api/v1/token');
        $body = $response->json();

        if ($response->status() === 200 && isset($body['token'])) {
            $request->session()->put('api_token', $body['token']);
            $request->session()->put('token_creation_time', now());

            return $next($request);
        } else {
            return Redirect::back()->with('error', 'Не вдалося отримати або зберегти токен');
        }
    }
}