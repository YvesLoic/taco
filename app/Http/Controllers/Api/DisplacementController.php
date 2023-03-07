<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TripException;
use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Requests\DisplacementRequest;
use App\Http\Resources\DisplacementResource;
use App\Models\Displacement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Routes pour les déplacements
 *
 * Opérations liés aux déplacements.
 */
class DisplacementController extends Controller
{
    /**
     * ListAll.
     *
     * Récupère la liste des déplacement fait par l'utilisateur qui émet la requette
     * selon une page et un nombre qu'il peut définir.
     *
     * @queryParam page integer numéro correspondant à la page à lire. Example: 1
     * @queryParam quantity integer nombre d'éléments à lire par page. Example: 10
     * @authenticated
     * @header Authorization Bearer ${token}
     * @apiResourceCollection App\Http\Resources\DisplacementResource
     * @apiResourceModel App\Models\Displacement
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function index(Request $request)
    {
        $user = auth('api')->user();
        $trip = Displacement::with(['client', 'car.user'])
            ->where('user_id', '=', $user->id)
            ->forPage(is_null($request->page) ? 1 : $request->page, is_null($request->quantity) ? 10 : $request->quantity)
            ->orderBy('created_at', 'desc')
            ->get();
        return ApiResponse::success(
            200,
            DisplacementResource::collection($trip)
        );
    }

    /**
     * Create.
     *
     * Ne sera plus utilisée en raison d'une migration technique.
     *
     * @bodyParam to string addresse de l'user lors de la demande. Example: Mvog Ada
     * @bodyParam to_lat float latitude de l'user lors de la demande. Example: 3,457896
     * @bodyParam to_lon float longitude de l'user lors de la demande. Example: 11,457896
     * @bodyParam from string destination de l'user lors de la demande. Example: Cité U
     * @bodyParam from_lat float latitude de destination de l'user lors de la demande. Example: 3,965241
     * @bodyParam from_lon float longitude de destination l'user lors de la demande. Example: 11,632945
     * @bodyParam distance float distance totale du trajet. Example: 8,06
     * @bodyParam price integer prix total du trajet. Example: 2500
     * @bodyParam status string statut du trajet. Example: pending
     * @bodyParam user_id integer client concerné par le trajet. Example: 1
     *
     * @param DisplacementRequest $request
     * @return Response|mixed
     */
    public function store(DisplacementRequest $request)
    {
        $request->validated();
        $trip = Displacement::query()->create(
            [
                'to' => $request->input('to'),
                'to_lat' => $request->input('to_lat'),
                'to_lon' => $request->input('to_lon'),
                'from' => $request->input('from'),
                'from_lat' => $request->input('from_lat'),
                'from_lon' => $request->input('from_lon'),
                'distance' => $request->input('distance'),
                'price' => $request->input('price'),
                'status' => $request->input('status'),
                'type' => $request->input('type'),
                'car_id' => $request->input('car_id'),
                'user_id' => $request->input('user_id'),
            ]
        );
        $trip = Displacement::with(['client', 'car.user'])->find($trip->id);
        return ApiResponse::success(
            200,
            new DisplacementResource($trip)
        );
    }

    /**
     * Delete.
     *
     * Supprime de la base de données la ressource demandée.
     *
     * @urlParam id number Identifiant de la ressource demandée. Example: 1
     * @apiResourceModel App\Http\Resources\UserResource
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @param Request $request
     * @return JsonResponse
     * @throws TripException
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $trip = Displacement::query()->find($id);
        if (!empty($trip)) {
            $trip->delete();
            return ApiResponse::success(200, null);
        }
        throw new TripException(__('labels.exception.not_found:' . $id), 404);
    }
}
