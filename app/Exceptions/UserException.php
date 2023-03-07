<?php

namespace App\Exceptions;

use App\Http\Helper\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserException extends Exception
{
    /**
     * Render the exception as an Http response
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function render(Request $request)
    {
        return new JsonResponse(ApiResponse::error($this->getCode(), $this->getTraceAsString()));
    }
}
