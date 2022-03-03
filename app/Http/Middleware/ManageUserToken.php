<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAuthorisedException;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ManageUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        auth()->shouldUse('api_user');

        $this->checkToken($request);

        return $next($request);
    }

    /**
     * Check if the token is valid.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws NotAuthorisedException
     */
    protected function checkToken(Request $request)
    {
        try {
            JWTAuth::parseToken()->authenticate();
            $payload = JWTAuth::parseToken()->getPayload();
            if ($payload->get('type') !== 'admin') {
                throw new NotAuthorisedException();
            }
        } catch (TokenExpiredException $e) {
            throw new NotAuthorisedException('Token has expired');
        } catch (\Exception $e) {
            throw new NotAuthorisedException('Invalid token');
        }
    }
}
