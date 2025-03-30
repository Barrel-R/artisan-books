<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminCredentials
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the environment variables are set
        if (empty(env('ADMIN_USERNAME'))) {
            abort(500, 'Admin username not configured');
        }

        if (empty(env('ADMIN_PASSWORD'))) {
            abort(500, 'Admin password not configured');
        }

        // Get the auth header
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Basic ')) {
            return response()->json(['message' => 'Unauthorized'], 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Access"'
            ]);
        }

        // Decode the credentials
        $credentials = base64_decode(substr($authHeader, 6));
        list($username, $password) = explode(':', $credentials, 2);

        // Verify credentials
        if ($username !== env('ADMIN_USERNAME') || $password !== env('ADMIN_PASSWORD')) {
            return response()->json(['message' => 'Invalid credentials'], 401, [
                'WWW-Authenticate' => 'Basic realm="Admin Access"'
            ]);
        }

        return $next($request);
    }
}
