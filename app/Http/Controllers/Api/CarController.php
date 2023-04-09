<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

/**
 * @group Routes pour les voitures
 *
 * Collection des opérations liés aux voitures.
 */
class CarController extends Controller
{
    /**
     * List.
     *
     * Renvoi la/les voiture(s) d'un utilisateur en particulier
     *
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @return JsonResponse
     */
    public function index()
    {
        $user = auth('api')->user();
        $car = Car::with(['type', 'user', 'pictures'])
            ->where('user_id', '=', $user->id)
            ->get();
        if (!empty($car)) {
            return ApiResponse::success(
                200,
                CarResource::collection($car)
            );
        }
        return ApiResponse::error(
            404,
            'No Car found for userId:' . $user->id
        );
    }

    /**
     * Show.
     *
     * Cherche une voiture par son identifiant et retourne ses informations.
     *
     * @urlParam id number Identifiant de la ressource demandée. Example: 1
     * @apiResourceModel App\Http\Resources\CarResource
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $car = Car::query()->with(['type', 'user', 'pictures'])->find($id);
        if (empty($car)) {
            return ApiResponse::error(404, __('labels.actions.messages.error.not_found'));
        }
        return ApiResponse::success(200, new CarResource($car));
    }
}
