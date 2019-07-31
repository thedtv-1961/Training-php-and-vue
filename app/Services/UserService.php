<?php


namespace App\Services;

use App\Repositories\User\UserInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
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
    public function createUser($user)
    {
        try {
            if (isset($user['avatar'])) {
                $user['avatar'] = $this->handleUploadAvatar($user['avatar']);
            }

            return $this->userRepository->create($user);
        } catch (\Exception $exception) {

            return false;
        }
    }

    public function getUser($id){
        return $this->userRepository->find($id);
    }

    /**
     * @param $avatar
     * @return string|null
     */
    private function handleUploadAvatar($avatar)
    {
        $imageName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path(config('users.avatar_path')), $imageName);

        return $imageName;
    }
}
