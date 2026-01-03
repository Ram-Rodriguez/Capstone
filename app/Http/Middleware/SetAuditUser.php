<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Support\AuditContext;

class SetAuditUser
{
    public function handle($request, Closure $next)
    {
        AuditContext::setUser(Auth::id());
        return $next($request);
    }
}
