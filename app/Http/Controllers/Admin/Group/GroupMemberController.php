<?php

namespace App\Http\Controllers\Admin\Group;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Group\GroupRepository;
use App\Repositories\User\UserRepository;

class GroupMemberController extends Controller
{
    /**
     * @var GroupRepository
     * @var UserRepository
    */
    protected $groupRepository, $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  GroupRepository  $groupRepository
     * @param  UserRepository  $userRepository
     * @return void
     */
    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Models\Group  $group;
     * @return \Illuminate\View
     */
    public function index(Group $group)
    {
        $users = $group->users()->paginate(config('settings.group_member.paginate'));

        return view('admin.group.members.index', ['users' => $users, 'group' => $group]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Group  $group;
     * @return \Illuminate\View
     */
    public function create(Group $group)
    {
        $users = $this->userRepository->all();

        return view('admin.group.members.create', ['group' => $group, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Group  $group;
     * @param  App\Http\Requests  $request;
     * @return \Illuminate\View
     */
    public function store(Group $group, Request $request)
    {
        $data = $request->only(['user_id']);
        $result = $group->users()->where('user_id',$data['user_id'])->first();
        if ($result)
        {
            return redirect()
                ->action('Admin\Group\GroupMemberController@create', $group->id)
                ->with('message_class', 'danger')
                ->with('message', trans('members.message.email_has_been_taken'));
        }

        $group->users()->attach($group->id, $data);

        return redirect()
            ->action('Admin\Group\GroupMemberController@index', $group->id)
            ->with('message_class', 'success')
            ->with('message', trans_choice('members.message.object_inserted_success', 0));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group;
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\View
     */
    public function destroy(Group $group, Request $request, $userId)
    {
        $user = $group->users()->detach($userId);
        if ($user)
        {
            return redirect()
            ->action('Admin\Group\GroupMemberController@index', $group->id)
            ->with('message_class', 'success')
            ->with('message', trans_choice('members.message.object_deleted_success', 0));
        }

        return redirect()
            ->action('Admin\Group\GroupMemberController@index', $group->id)
            ->with('message_class', 'danger')
            ->with('message', trans_choice('members.message.object_deleted_fail', 0));
    }
}
