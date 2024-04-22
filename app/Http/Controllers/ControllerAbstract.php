<?php

namespace App\Http\Controllers;

use App\Http\Handlers\Responses\ResponseTrait;

/**
 * @OA\Info(
 *    title="My Tasks API",
 *    description="An API of tasks management",
 *    version="1.0.0",
 * ),
 * @OA\SecurityScheme(
 *      type="apiKey",
 *      in="header",
 *      securityScheme="token",
 *      name="Authorization"
 *  )
 */
class ControllerAbstract extends Controller
{
    use ResponseTrait;
}
