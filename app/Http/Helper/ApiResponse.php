<?php


namespace App\Http\Helper;

use Illuminate\Http\JsonResponse;

/**
 * @group Format de réponse des différentes requettes
 */
class ApiResponse
{
    /**
     * @param int $code
     * @param mixed $error
     * @return JsonResponse
     */
    public static function error($code, $error)
    {
        return response()->json(['error' => $error], $code);
    }

    /**
     * @param int $code
     * @param mixed $data
     * @return JsonResponse
     */
    public static function success($code, $data)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * @param int $code
     * @param mixed $data
     * @param string $token
     * @return JsonResponse
     */
    public static function withHeader($code, $data, $token)
    {
        return response()
            ->json(
                [
                    'data' => $data
                ],
                $code
            )->header('Authorization', 'Bearer ' . $token);
    }
}
