<?php

namespace App\Http\Controllers\Admin\Group;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Repositories\Group\GroupRepository;

class AnnouncementController extends Controller
{
    /** 
     * @var GroupRepository
     * 
    */
    protected $groupRepository;

    /**
     * Create a new controller instance.
     *
     * @param  GroupRepository  $groupRepository
     * @return void
     */
    public function __construct(GroupRepository $groupRepository) {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $announcements = $group->announcements()->paginate(10);

        return view('admin.announcements.index', [
            'group' => $group,
            'announcements' => $announcements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        return view('admin.announcements.create', [
            'group' => $group,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Group $group, AnnouncementRequest $request)
    {   
        $data = $request->only([
            'content',
        ]);
        $announcements = $group->announcements()->create($data);

        return redirect()->route('groups.announcements.index', $group);
    }
}
