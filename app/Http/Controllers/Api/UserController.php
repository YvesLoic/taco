<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserException;
use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Routes pour utilisateurs
 *
 * Collection des opérations liées aux utilisateurs.
 */
class UserController extends Controller
{
    private $_around;

    public function __construct()
    {
        $this->_around = config('app.around');
    }

    /**
     * ListAll.
     *
     * Les utilisateurs retournés sont fonction du périmètre passé en paramètre.
     *
     * @queryParam distance int distance autour de l'utilisateur qui fait la demande. Default is 2000m/2km. Example: 1500
     * @queryParam lat float latitude de l'utilisateur qui fait la demande. Example: 3.851248
     * @queryParam lon float longitude de l'utilisateur qui fait la demande. Example: 11.154879
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @apiResourceCollection App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $around = is_null($request->distance) ? $this->_around : $request->distance;
        $latitude = $request->lat;
        $longitude = $request->lon;

        $usersNearBy = User::query()
            ->select(
                '*',
                DB::raw('6371 * acos(cos(radians(' . $latitude . '))
                * cos(radians(latitude)) * cos(radians(longitude) - radians(' . $longitude . '))
                + sin(radians(' . $latitude . ')) * sin(radians(latitude))) AS distance')
            )->having('distance', '<=', $around / 1000)
            ->orderBy('distance')
            ->get();
        $drivers = array_filter(iterator_to_array($usersNearBy), function ($user) {
            return $user->roles->pluck('name')[0] == "driver";
        });

        return ApiResponse::success(
            200,
            UserResource::collection($drivers)
        );
    }

    /**
     * Create.
     *
     * Enregistrement des informations liées au nouvel utilisateur
     *
     * @bodyParam first_name string required prénom de l'utilisateur. Example: John
     * @bodyParam last_name string required nom de l'utilisateur. Example: Doe
     * @bodyParam email string adresse e-mail de l'utilisateur. Example: johndoe@example.com
     * @bodyParam phone number required numéro de téléphone de l'utilisateur. Example: 698586208
     * @bodyParam ip_address string required adresse ip de l'utilisateur. Example: 152.72.160.127
     * @bodyParam latitude float latitude de l'utilisateur. Example: 3.86223
     * @bodyParam longitude float longitude de latitude de l'utilisateur. Example: 11.5297795
     *
     * @apiRequest App\Http\Requests\UserStoreRequest
     * @apiResourceModel App\Models\User
     * @authenticated
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $request->validated();
        $data = Location::get($request->input('ip_address'));
        $city = City::query()
            ->where('country', $data->countryName)
            ->firstOr(function () use ($data) {
                return City::create([
                    'country' => $data->countryName,
                    'city' => $data->cityName,
                    'country_code' => $data->countryCode,
                ]);
            });
        $newUser = User::create(
            [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'ip_address' => $request->input('id_address'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'password' => Hash::make($request->input('phone')),
                'city_id' => $city->id,
            ]
        );
        $newUser->assignRole('client');
        $token = JWTAuth::fromUser($newUser);
        return ApiResponse::withHeader(
            200,
            new UserResource($newUser),
            $token
        );
    }

    /**
     * Show.
     *
     * Cherche un utilisateur par son identifiant et retourne ses informations.
     *
     * @urlParam id number Identifiant de la ressource demandée. Example: 1
     * @apiResourceModel App\Http\Resources\UserResource
     * @authenticated
     * @header Authorization Bearer ${token}
     *
     * @param int $id
     * @return JsonResponse
     * @throws UserException
     */
    public function show($id)
    {
        $user = User::query()->find($id);
        if (empty($user)) {
            throw new UserException(__('labels.exception.not_found:' . $id), 404);
        }
        return ApiResponse::success(200, new UserResource($user));
    }

    /**
     * Update.
     *
     * Met à jour les informations en rapport avec un utilisateur en Base de données.
     *
     * @bodyParam first_name string required prénom de l'utilisateur. Example: John
     * @bodyParam last_name string required nom de l'utilisateur. Example: Doe
     * @bodyParam email string adresse e-mail de l'utilisateur. Example: johndoe@example.com
     * @bodyParam phone number required numéro de téléphone de l'utilisateur. Example: 693624491
     * @bodyParam ip_address string required adresse ip de l'utilisateur. Example: 152.72.160.127
     * @bodyParam latitude float latitude de l'utilisateur. Example: 3.86223
     * @bodyParam longitude float longitude de l'utilisateur. Example: 11.5297795
     * @apiRequest App\Http\Requests\UserUpdateRequest
     * @apiResourceModel App\Models\User
     * @authenticated
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws UserException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $val = $request->validated();
        $updated_user = User::query()->find($id);
        if (empty($updated_user)) {
            throw new UserException(__('labels.exception.not_found:' . $id), 404);
        }
        $updated_user->update($val);
        return ApiResponse::success(
            200,
            new UserResource($updated_user)
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
     * @param int $id
     * @return JsonResponse
     * @throws UserException
     */
    public function destroy($id)
    {
        $user = User::query()->find($id);
        if (!empty($user)) {
            $user->delete();
            return ApiResponse::success(200, null);
        }
        throw new UserException(__('labels.exception.not_found:' . $id), 404);
    }
}
