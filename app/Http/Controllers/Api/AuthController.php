<?php

namespace App\Http\Controllers\Api;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserInterface;

class AuthController extends Controller
{
    /** var UserInterface */
    protected $userRepository;

    /**
     * AuthController constructor.
     * @param  UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function getUser(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Login user and create token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => trans('auth.failed'),
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => $user,
        ], config('code.success_code.success'));
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return string message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => trans('auth.logout'),
        ], config('code.success_code.success'));
    }

    /**
     * Create user
     *
     * @param  $request
     * @return string message
     */
    public function signup(RegisterRequest $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
        ]);

        $user = $this->userRepository->firstOrCreate($data);
        
        if ($user) {
            return response()->json([
                'message' => trans('auth.register_success'),
            ], config('code.success_code.success'));
        }
    }
}
