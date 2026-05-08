<?php

namespace App\Http\Middleware;

use Closure;
use App\Handlers\AuthorizationHandler;

class AdminMiddleware
{
    protected $authHandler;
    
    public function __construct()
    {
        $this->authHandler = new AuthorizationHandler();
    }
    
    public function handle($request, Closure $next)
    {
        if (!$this->authHandler->isAdmin()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }
        
        return $next($request);
    }
}