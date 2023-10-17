<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class AuthCompany
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //check if user is logged in
        /** @var Client $client */
        $client = auth()->guard('client')->user();

        //if not, redirect to login page
        if (!$client) {
            return redirect('/');
        }

        //if user is logged in, continue to next middleware
        return $next($request);
    }
}
