<?php

namespace App\Http\Controllers\Api\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileProcesser;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    use FileProcesser;

    /**
     * @var userRepository
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
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  int  $id
     *
     * @return Illuminate\Http\JsonResponse
     *
     * @throws Exception
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->update($id, $request->all());

            return response()->json($user);
        } catch (Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                $errorCode = 404;
            } else {
                $errorCode = 500;
            }

            return response()->json([
                'error_message' => $e->getMessage(),
                'error_code' => $errorCode,
            ]);
        }
    }

    /**
     * Change user avatar
     * @param  UploadImageRequest  $request
     *
     * @return Illuminate\Http\JsonResponse
     *
     * @throws Exception
     */
    public function changeAvatar(UploadImageRequest $request)
    {
        try {
            $id = $request->id;
            $user = $this->userRepository->find($id);
            $updateData['avatar'] = $this->userRepository->uploadAvatar(
                $request,
                'avatar',
                $user->avatar,
                config('settings.path_upload_avatar')
            );
            $user = $this->userRepository->update($id, $updateData);

            return response()->json($user);
        } catch (Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                $errorCode = 404;
            } else {
                $errorCode = 500;
            }

            return response()->json([
                'error_message' => $e->getMessage(),
                'error_code' => $errorCode,
            ]);
        }
    }
}
