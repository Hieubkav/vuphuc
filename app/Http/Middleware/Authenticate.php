<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Check if this is a customer route
        if ($request->is('khach-hang/*') || $request->is('customer/*')) {
            return route('customer.login');
        }

        // Default to admin login for other routes
        return '/admin/login';
    }
}
