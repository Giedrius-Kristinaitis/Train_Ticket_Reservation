<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

abstract class AbstractRoleVerifier
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Closure
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->hasRole($this->getRoleToVerify())) {
            return redirect('/');
        }

        return $next($request);
    }

    /**
     * @return string
     */
    abstract protected function getRoleToVerify(): string;
}