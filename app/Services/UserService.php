<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\FileProcesser;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
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
                'password',
                'name',
                'gender',
                'birthday',
                'phone',
                'address',
                'avatar',
            ]);

            if (isset($request['avatar'])) {
                $user['avatar'] = $this->userRepository->uploadAvatar($request, 'avatar', null, config('settings.path_upload_avatar'));
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
                $oldAvatarName = null;

                if (isset($request['old_avatar'])) {
                    $oldAvatarName = $request['old_avatar'];
                }

                $user['avatar'] = $this->userRepository->uploadAvatar($request, 'avatar', $oldAvatarName, config('settings.path_upload_avatar'));
            }

            return $this->userRepository->update($id, $user);
        } catch (\Exception $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getUsers(Request $request)
    {
        $id = $request->get('id') != null ? $request->get('id') : null;
        $name = $request->get('name') != '' ? $request->get('name') : '';
        $email = $request->get('email') != '' ? $request->get('email') : '';
        $gender = $request->get('gender') != '' ? $request->get('gender') : '';
        $birthday = $request->get('birthday') != null ? $request->get('birthday') : null;
        $sort = $request->get('sort') != '' ? $request->get('sort') : 'desc';
        $sortByField = $request->get('field') != '' ? $request->get('field') : 'id';

        $users = !empty($id) ? $this->userRepository->where('id', $id) : $this->userRepository;

        return $users->likeSearch($name, 'name')
            ->likeSearch($email, 'email')
            ->likeSearch($gender, 'gender')
            ->likeSearch($birthday, 'birthday')
            ->orderBy($sortByField, $sort)
            ->paginate(config('users.row_per_page'))
            ->withPath('?id=' . $id . '&name=' . $name . '&email=' . $email . '&gender=' . $gender . '&birthday=' . $gender);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function removeUser(Request $request)
    {
        try {
            $this->userRepository->find($request->user)->delete();

            return true;
        } catch (\Exception $exception) {
            report($exception);

            return false;
        }
    }
}
