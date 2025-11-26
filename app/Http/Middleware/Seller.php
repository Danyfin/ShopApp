<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Seller
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isSeller() && !auth()->user()->isAdmin()) {
            abort(403, 'Доступ запрещен. Требуются права продавца или администратора.');
        }

        return $next($request);
    }
}