<?php

namespace App\Exceptions;

use Exception;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \Cartalyst\Stripe\Exception\CardErrorException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof \Illuminate\Validation\ValidationException){
            return redirect()->back();
        }
        if(method_exists($exception, "getStatusCode" ) && $exception->getStatusCode() == 404){
            return response()->view('errors.404', [], 404);
        }
        if($exception instanceof \Illuminate\Auth\AuthenticationException){
            $this->unauthenticated($request, $exception);
            return parent::render($request, $exception);
        }
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
            return response()->view('home');
            return parent::render($request, $exception);
        }
        if($exception instanceof \Cartalyst\Stripe\Exception\CardErrorException){
            return redirect()->back()->with('error', "Veuillez saisir 4242 4242 4242 4242");
        }
        if($exception){
           //return response()->view('errors.500', [], 500);
	    }
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(),0);

        //using switch statement to switch between the guards
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
