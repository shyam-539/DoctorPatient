<?php

namespace App\Exceptions;

use App\Http\Constants\AuthConstans;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * handle if unauthenticated
     *
     * @param mixed $request
     * @param AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = Arr::get($exception->guards(), '0');
        switch ($guard) {
        case AuthConstans::GUARD_ADMIN:
            $login = 'admin.login';
            break;

        case AuthConstans::GUARD_USER:
            $login = 'user.login';
            break;

        default:
            $login = 'home';
            break;
        }
        return redirect()->guest(route($login));
    }

}
