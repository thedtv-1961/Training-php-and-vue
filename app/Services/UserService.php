<?php

namespace App\Services;

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
     * @param User $user
     * @return bool
     */
    public function createUser($request)
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

            return false;
        }
    }
}
