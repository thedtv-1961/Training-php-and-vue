<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;

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
     * @return Illuminate\Http\Response
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
        $user = $request->only([
            'email',
            'name',
            'gender',
            'birthday',
            'phone',
            'address',
            'avatar'
        ]);
        $user['password'] = bcrypt($request->password);
        $result = $this->userService->createUser($user);

        if ($result) {
            return redirect()
                ->action('UserController@create')
                ->with('message_class', 'success')
                ->with('message', trans_choice('user.message.object_inserted_success', 0));
        }
        return redirect()
            ->action('UserController@create')
            ->with('message_class', 'danger')
            ->with('message', trans_choice('user.message.object_inserted_fail', 0));
    }
}
