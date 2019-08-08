<?php

namespace App\Http\Controllers\Api\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GroupController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = auth()->user()->groups;

        return response()->json($groups);
    }
}
