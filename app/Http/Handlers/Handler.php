<?php

namespace App\Http\Handlers;

use App\Http\Handlers\Exceptions\BadRequestHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof RouteNotFoundException) {
                throw new BadRequestHttpException($e->getMessage());
            }
        });
    }

    public function render($request, Throwable $e)
    {
        $isProduction = config('app.env') === 'production';
        $isDebug = config('app.debug');
        $isMaintenance = config('app.env') === 'maintenance';

        if ($isDebug){
            Log::debug(
                $e->getMessage()
            );
        }

        if($isMaintenance){
            return response()->noContent();
        }

        if($isProduction){
            if($isDebug){
                return response()->json(['message' => $e->getMessage()], $e->getCode());
            }
            return response()->json(['message' => 'Ocorreu um erro no servidor'], 500);
        }

        if ($e instanceof ModelNotFoundException) {

            return response()->json(['message' => 'Recurso não encontrado'], 404);

        } elseif ($e instanceof NotFoundHttpException) {

            return response()->json(['message' => 'Página não encontrada'], 404);

        }

        return parent::render($request, $e);
    }

}
