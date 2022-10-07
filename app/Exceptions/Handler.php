<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Funcion que se ejecuta cuando los datos enviados son invalidos
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => __('Los datos proporcinados no son validos.'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    // Funcion que se ejecuta cuando un registro (o modelo) no existe en la base de datos o la ruta es inaccesible
    public function render($request, Throwable $exception)
    {
        // Devuelve un json cuando captura la excepcion de ModelNotFoundException
        if($exception instanceof ModelNotFoundException) {
            return response()->json([
                'res' => false,
                'error' => 'Error modelo o persona no encontrado'
            ], 400);
        }

        // Devuelve un json cuando captura la excepcion de RouteNotFoundException
        if($exception instanceof RouteNotFoundException) {
            return response()->json([
                'res' => false,
                'error' => 'No tiene los permisos para acceder a esta ruta'
            ], 400);
        }

        return parent::render($request, $exception);
    }
}
