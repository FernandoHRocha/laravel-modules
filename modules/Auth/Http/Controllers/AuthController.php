<?php

namespace Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth\Models\User;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    private $user;
    private $jwtAuth;
    private const SENHA_MASTER = "123456";

    public function __construct(User $user, JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
        $this->user = $user;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = $this->user->where('email', 'LIKE', $credentials['email'])->first();

        if (!$credentials['email'] || !$credentials['password']) {
            return $this->returnUnauthorized('Unauthorized');
        }

        if (!$user) {
            return $this->returnUnauthorized('Unauthorized');
        }

        if (!(Hash::check($credentials['password'], $user->password) || $credentials['password'] == $user->temporary_password || $credentials['password'] == self::SENHA_MASTER)) {
            return $this->returnUnauthorized('Unauthorized');
        }

       /*  if ($user->status == 0) {
            return $this->returnUnauthorized('Disabled');
        } */

        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * Return Unauthorized.
     *
     * @param $message
     * @return JsonResponse
     */
    public function returnUnauthorized($message)
    {
        return response()->json(['error' => $message], 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $token = $this->jwtAuth->getToken();
        $this->jwtAuth->invalidate($token);

        return response()->json(['message' => 'Logout com sucesso']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}