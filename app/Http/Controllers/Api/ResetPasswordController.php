<?php

namespace App\Http\Controllers\Api;

use Mail;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /** 
     * @var $userRepository 
     * 
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     * 
     * @param  UserInterface  $userRepository
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create token password reset.
     *
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMail(EmailRequest $request)
    {
        $userMail = $this->userRepository->whereFirst('email', $request->email);
        
        if (!$userMail) {
            return response()->json([
                'message' => trans('auth.email_not_found'),
            ], 404);
        }

        $input = [
            'reset_token' => str_random(40) . time() . uniqid(true),
            'reset_token_expires_at' => Carbon::now()->addMinutes(30),
        ];

        $user = $this->userRepository->update($userMail->id, $input);

        if ($user) {
            Mail::to($request->email)->queue((new ResetPassword($input))->onConnection('database'));

            return response()->json([
                'message' => trans('auth.send_mail_password'),
            ], 200);
        }
    }

    /**
     * Find token password reset
     *
     * @param  string  $token
     * 
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function checkToken($token)
    {
        $passwordReset = $this->userRepository->whereFirst('reset_token', $token);

        if (!$passwordReset) {
            return response()->json([
                'message' => trans('auth.token_invalid'),
            ], 404);
        }

        if (Carbon::now() > $passwordReset->reset_token_expires_at) {
            return response()->json([
                'message' => trans('auth.token_expired'),
            ], 404);
        }

        return response()->json([
            'message' => 'OK',
        ], 200);
    }

    /**
     * Handle reset password
     *
     * @param  ResetPasswordRequest  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->only([
            'reset_token',
            'password',
            'password_confirmation',
        ]);

        $getUser = $this->userRepository->whereFirst('reset_token', $data['reset_token']);

        if (!$getUser) {
            return response()->json([
                'message' => trans('auth.token_invalid'),
            ], 404);
        }

        if (Carbon::now() > $getUser->reset_token_expires_at) {
            return response()->json([
                'message' => trans('auth.token_expired'),
            ], 404);
        }

        $updatePasswordUser = $this->userRepository->update($getUser->id, ['password' => $data['password']]);

        if ($updatePasswordUser) {
            $this->userRepository->update($getUser->id, [
                    'reset_token' => null,
                    'reset_token_expires_at' => null,
                ]);

            return response()->json([
                'message' => 'OK',
            ], 200);
        }
    }
}
