<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Traits\FileProcesser;
use App\Repositories\User\UserInterface;

class UserService
{
    use FileProcesser;

    /**
     * @var UserInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRequest $request
     * @return bool
     */
    public function createUser(UserRequest $request)
    {
        try {
            $user = $request->only([
                'email',
                'name',
                'gender',
                'birthday',
                'phone',
                'address',
                'avatar',
            ]);
            $user['password'] = bcrypt($request->password);

            if (isset($request['avatar'])) {
                $user['avatar'] = $this->uploadImage($request['avatar'], config('users.avatar_path'));
            }

            return $this->userRepository->create($user);
        } catch (\Exception $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * @param int $id
     * @return UserRepository
     */
    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * @param int $id
     * @param UserUpdateRequest $request
     * @return bool
     */
    public function updateUser($id, UserUpdateRequest $request)
    {
        try {
            $user = $request->only([
                'email',
                'name',
                'gender',
                'birthday',
                'phone',
                'address',
                'avatar',
            ]);

            if (isset($request['password'])) {
                $user['password'] = bcrypt($request->password);
            }

            if (isset($request['avatar'])) {
                $user['avatar'] = $this->uploadImage($request['avatar'], config('users.avatar_path'));

                if (isset($request['old_avatar'])) {
                    $this->deleteImage(public_path($request['old_avatar']));
                }
            }

            return $this->userRepository->update($id, $user);
        } catch (\Exception $exception) {
            report($exception);

            return false;
        }
    }
}
