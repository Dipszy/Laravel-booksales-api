<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek autentikasi user (baik via Auth guard maupun header X-User-Id / header token)
        $user = $request->user();

        // Dukungan pengujian langsung via Header di Postman: X-User-Id atau X-User-Email
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

        // 3. Jika user bukan admin
        if ($user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden: Akses ditolak! Operasi Create, Update, dan Destroy hanya dapat diakses oleh Admin.'
            ], 403);
        }

        return $next($request);
    }
}
