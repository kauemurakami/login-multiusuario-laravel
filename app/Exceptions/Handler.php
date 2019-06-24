<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
 use illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
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
        return parent::render($request, $exception);
    }

    # capturar evento de nao autenticado
    # @2 exception vinda de AuthenticatedException >>use contendo array de guards que temos
    protected function unauthenticated($request, AuthenticationException $exception){
        $guard = array_get($exception->guards(), 0 );//
        

        # Caso fosse uma api
        if ($request->excpectsJson()) {
            return response()->json(['messages'=>$exception->getMessage()], 401);
        }


        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            case 'web':
                $login = 'login';
                break;
            default:
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login));
    }

}
