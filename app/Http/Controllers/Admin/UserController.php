<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Test;

class UserController extends Controller
{
    /**
     * @var UserServcice
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\View
     */
    public function create()
    {
        $user = new User();

        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->userService->createUser($request);

        if ($result) {
            return redirect()
                ->action('Admin\UserController@create')
                ->with('message_class', 'success')
                ->with('message', trans_choice('user.message.object_inserted_success', 0));
        }

        return redirect()
            ->action('Admin\UserController@create')
            ->with('message_class', 'danger')
            ->with('message', trans_choice('user.message.object_inserted_fail', 0));
    }

    /**
     * @param int $id
     * @return \Illuminate\View
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param int $id
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UserUpdateRequest $request)
    {
        $result = $this->userService->updateUser($id, $request);

        if ($result) {
            return redirect()
                ->action('Admin\UserController@edit', $id)
                ->with('message_class', 'success')
                ->with('message', trans_choice('user.message.object_updated_success', 0));
        }

        return redirect()
            ->action('Admin\UserController@edit', $id)
            ->with('message_class', 'danger')
            ->with('message', trans_choice('user.message.object_updated_fail', 0));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        Mail::send(new Test());
        $users = $this->userService->getUsers($request);

        return view('admin.users.index', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $result = $this->userService->removeUser($request);

        if ($result) {
            return redirect()
                ->action('Admin\UserController@index')
                ->with('message_class', 'success')
                ->with('message', trans_choice('user.message.object_deleted_success', 0));
        }

        return redirect()
            ->action('Admin\UserController@index')
            ->with('message_class', 'danger')
            ->with('message', trans_choice('user.message.object_deleted_fail', 0));
    }
}
