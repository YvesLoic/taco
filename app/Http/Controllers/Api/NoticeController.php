<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Requests\NoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Route pour les avis
 *
 * Collections des opérations sur les avis émis par les différents clients.
 */
class NoticeController extends Controller
{
    /**
     * ListAll.
     *
     * Récupère la liste des avis de l'utilisateur qui émet la requette
     * selon une page et un nombre qu'il peut définir.
     *
     * @queryParam page integer numéro correspondant à la page à lire. Example: 1
     * @queryParam quantity integer nombre d'éléments à lire par page. Example: 10
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @apiResourceModel App\Models\Notice
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth('api')->user();
        $notices = Notice::query()
            ->where('user_id', '=', $user->id)
            ->forPage(is_null($request->page) ? 1 : $request->page, is_null($request->quantity) ? 10 : $request->quantity)
            ->get();
        return ApiResponse::success(
            200,
            NoticeResource::collection($notices)
        );
    }

    /**
     * Create.
     *
     * Permet à un utilisateur d'enregistrer un nouvel avis.'
     *
     * @bodyParam content string contenu de l'avis.
     * @bodyParam note integer note de l'avis. Example: 4
     * @bodyParam sender_id integer utilisateur qui émet l'avis. Example: 1
     * @bodyParam receiver_id integer utilisateur concerné par l'avis. Example: 2
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @apiRequest App\Http\Requests\NoticeRequest
     *
     * @param NoticeRequest $request
     * @return JsonResponse
     */
    public function store(NoticeRequest $request)
    {
        $notice = $request->validated();
        $note = Notice::query()->create($notice);
        $notice = Notice::with(['sender', 'receiver'])->find($note->id);
        return ApiResponse::success(
            200,
            new NoticeResource($notice)
        );
    }
}
