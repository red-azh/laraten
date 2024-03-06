<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleLevel
{
    // fungsi ini buat mengelola request user kalau ada rolenya, kalau user itu ada rolenya yang cocok makanya di boklehka untuk mnelalkukan request selanjutnya
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // kasih logika kalau user ada role yang sesuai
        if (in_array($request->user()->role, $roles)) {

            return $next($request);
        }
        // ini kondisii dimana user tidak boleh melwati jalur itu
        return abort(403);
    }
}
