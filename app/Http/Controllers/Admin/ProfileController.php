<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\FileProcesser;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UploadImageRequest;

class ProfileController extends Controller
{
    use FileProcesser;

    /** 
     * @var $userRepository
     * 
    */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  UserInterface  $userRepository
     * 
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get profile of user
     * 
     * @return View
     */
    public function getProfile()
    {
        $user = auth()->user();
        $genders = [
            config('users.gender.female') => trans('user.variable.gender.female'),
            config('users.gender.male') => trans('user.variable.gender.male'),
            config('users.gender.other_gender') => trans('user.variable.gender.other_gender'),
        ];

        return view('admin.profile.index', compact('user', 'genders'));
    }

    /**
     * Update profile of user
     * 
     * @param  UpdateUserRequest  $request
     * 
     * @return Illuminate\Http\RedirectResponse
     * 
     * @throws Exception
     */
    public function updateProfile(UpdateUserRequest $request)
    {
        try {
            $user = $this->userRepository->update($request->id, $request->all());
            session()->flash('profile.success', trans('user.profile.update.success'));
        } catch (Exception $e) {
            session()->flash('profile.error', $e->getMessage());
        }

        return redirect()->route('get_profile');
    }

    /**
     * Change user avatar
     * 
     * @param  UploadImageRequest  $request
     * 
     * @return Illuminate\Http\RedirectResponse
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
            session()->flash('profile.success', trans('user.profile.update.avatar.success'));
        } catch (Exception $e) {
            session()->flash('profile.error', $e->getMessage());
        }

        return redirect()->route('get_profile');
    }
}
