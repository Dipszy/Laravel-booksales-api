<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureUserIsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek autentikasi user (baik via Auth guard maupun header X-User-Id / X-User-Email untuk kemudahan testing)
        $user = $request->user();

        if (!$user) {
            if ($request->hasHeader('X-User-Id')) {
                $user = User::find($request->header('X-User-Id'));
            } elseif ($request->hasHeader('X-User-Email')) {
                $user = User::where('email', $request->header('X-User-Email'))->first();
            }
        }

        // 2. Jika user belum terautentikasi / belum login
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Anda belum terautentikasi / belum login.'
            ], 401);
        }

        // 3. Jika user bukan customer
        if ($user->role !== 'customer') {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden: Akses ditolak! Operasi ini hanya dapat diakses oleh Customer yang terautentikasi.'
            ], 403);
        }

        // Simpan instance user terotentikasi ke dalam request
        $request->setUserResolver(fn() => $user);

        return $next($request);
    }
}
