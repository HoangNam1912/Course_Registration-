<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\MiddlewarePriority;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Illuminate\Session\Middleware\StartSession;
    

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checklogin' => \App\Http\Middleware\CheckLogin::class,
            'checkrole' => \App\Http\Middleware\CheckRole::class,
            'error' => \Illuminate\Support\Facades\Blade::class,
            'auth.api' => \App\Http\Middleware\AuthorizeApiToken::class,
            'jwt.web' => \App\Http\Middleware\CheckWebAccess::class,
            'auth.web' => \App\Http\Middleware\AuthorizeWebAccess::class,
        ]);      
         $middlewareGroups = [
            'web' => [
                // ...
                \Illuminate\Session\Middleware\StartSession::class,
            ],
        ];    
        $middleware->validateCsrfTokens(except: [
            '*',
        ]);
    })

    
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle exceptions if needed
        
    })
    ->create();

