<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
    ];

    public function handle($request, \Closure $next)
    {
        $response = parent::handle($request, $next);

        // If Laravel returns 419 response
        if (method_exists($response, 'status') && $response->status() === 419) {

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'SESSION_EXPIRED'
                ], 419);
            }

            return redirect()->route('session.recover');
        }

        return $response;
    }

    protected function tokensMatch($request)
    {
        $result = parent::tokensMatch($request);

        if (! $result) {

            // force custom behavior on mismatch
            if ($request->expectsJson()) {
                response()->json(['message' => 'SESSION_EXPIRED'], 419)->send();
                exit;
            }

            redirect()->route('session.recover')->send();
            exit;
        }

        return true;
    }
}
