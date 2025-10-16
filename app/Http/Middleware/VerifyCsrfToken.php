<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/install/details',
        '/install/post-details',
        '/install/install-alternate',
        '/api/ecom/customers',
        '/api/ecom/orders',
        '/webhook/*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // Handle Arabic RTL specific CSRF token issues
        if ($this->isArabicLocale($request)) {
            $this->handleArabicCsrfToken($request);
        }

        return parent::handle($request, $next);
    }

    /**
     * Check if the current locale is Arabic
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isArabicLocale($request)
    {
        $locale = $request->session()->get('user.language', config('app.locale'));
        return $locale === 'ar' || app()->getLocale() === 'ar';
    }

    /**
     * Handle CSRF token for Arabic locale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function handleArabicCsrfToken($request)
    {
        // Ensure session is properly started for Arabic users
        if (!$request->session()->isStarted()) {
            $request->session()->start();
        }

        // Add additional headers for Arabic RTL compatibility
        if ($request->ajax() || $request->wantsJson()) {
            $request->headers->set('Accept-Language', 'ar');
        }
    }
}
