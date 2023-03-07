<?php

namespace App\Http\Controllers\Api;

use App\Events\AlertEvent;
use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Requests\AlertRequest;
use App\Models\Alert;
use Illuminate\Http\JsonResponse;

/**
 * @group Routes pour les Alertes
 *
 * Collection des opérations liées à l'émissions des aletes clients.
 */
class AlertController extends Controller
{

    /**
     * Create.
     *
     * @bodyParam content string Content of user's alert. Example: There is some trouble here, Help
     * @bodyParam type string Content type of user's alert. Example: Warning
     * @bodyParam displacement_id integer Parent ID trip related to the alert. Example: 1
     *
     * @header Authorization Bearer ${token}
     * @authenticated
     *
     * @apiRequest App\Http\Requests\AlertRequest
     * @apiResourceModel App\Models\Alert
     *
     * @param AlertRequest $request
     * @return JsonResponse
     */
    public function store(AlertRequest $request)
    {
        $val = $request->validated();
        $alert = Alert::query()->create($val);
        $alert = Alert::with('displacement.user')->find($alert->id);
        event(new AlertEvent($alert));
        return ApiResponse::success(
            200,
            $alert
        );
    }

}
