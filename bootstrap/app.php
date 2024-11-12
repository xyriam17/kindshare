<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocaleMiddleware;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Middleware\EnsureTokenIsValid;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->web(LocaleMiddleware::class);
  })
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->redirectGuestsTo('auth/login');
    // Using a closure...
    $middleware->redirectGuestsTo(fn(Request $request) => route('auth-login'));
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
