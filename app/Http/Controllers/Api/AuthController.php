<?php

namespace App\Http\Controllers\Api;

use App\Events\UserTracking;
use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Routes pour l'authentification
 *
 * Collection des opérations d'authentification des différents utilisateurs.
 */
class AuthController extends Controller
{

    /**
     * Login.
     *
     * Assure la connexion d'un utilisateur au système
     *
     * @bodyParam phone numeric required numéro de téléphone de l'utilisateur. Example: 698586208
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            if (!$token = JWTAuth::attempt(['phone' => $request->phone, 'password' => $request->phone])) {
                return ApiResponse::error(400, 'Invalid_credentials');
            }
            return ApiResponse::withHeader(200, new UserResource(Auth::user()), $token);
        } catch (Exception $e) {
            return ApiResponse::error(400, $e->getMessage());
        }
    }

    /**
     * Log out.
     *
     * Assure la déconnexion d'un utilisateur au système
     *
     * @header Authorization Bearer ${token}
     * @authenticated
     *
     * @return JsonResponse
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return ApiResponse::success(200,null);
        }
        return ApiResponse::error(403, 'Can\'t logged out');
    }

    /**
     * Refresh token.
     *
     * Fournit aux utilisateur un nouveau jeton d'accès après expiration du précédent
     *
     * @queryParam token string access token of the authenticated user. Example: esaihegfvauijona,edihYZTUVdhbci...
     * @bodyParamn lat integer required latitude de celui qui émet la demande. Example: 3.569847
     * @bodyParamn lon integer required longitude de celui qui émet la demande. Example: 11.984573
     * @bodyParamn ip_address required string addresse Ip de celui qui émet la demande. Example: 154.72.162.27
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        try {
            $refreshed = JWTAuth::refresh(JWTAuth::getToken());
            $user = JWTAuth::setToken($refreshed)->toUser();
            $request->header('Authorization', 'Bearer ' . $refreshed);
            event(new UserTracking($user, $request->input('lat'), $request->input('lon'), $request->input('ip_address')));
            return ApiResponse::withHeader(200, new UserResource($user), $refreshed);
        } catch (JWTException $e) {
            return ApiResponse::error(550, $e->getMessage());
        }
    }
}
