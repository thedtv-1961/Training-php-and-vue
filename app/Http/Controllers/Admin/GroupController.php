<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Test;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Traits\FileProcesser;
use App\Http\Controllers\Controller;
use App\Repositories\Group\GroupRepository;
use App\Http\Requests\Group\CreateGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use Illuminate\Support\Facades\Mail;

class GroupController extends Controller
{
    use FileProcesser;

    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->get('search');
        $field = $request->get('field') != '' ? $request->get('field') : 'name';
        $sort = $request->get('sort') != '' ? $request->get('sort') : 'asc';
        $groups = $this->groupRepository->likeSearch('name', $search)->orderBy($field, $sort)->paginate(10)
            ->withPath('?search=' . $search . '&field=' . $field . '&sort=' . $sort);

        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group();

        return view('admin.groups.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGroupRequest $request)
    {
        $group = $this->groupRepository->create($this->groupParams($request));

        return redirect('/admin/groups');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($this->groupParams($request));

        return redirect('/admin/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect('/admin/groups');
    }

    private function groupParams($request)
    {
        $group = $request->only([
            'name',
            'description',
            'image',
        ]);
        if (isset($request['image'])) {
            $group['image'] = $this->uploadImage($request['image'], config('groups.image_path'));
        }

        return $group;
    }

}
