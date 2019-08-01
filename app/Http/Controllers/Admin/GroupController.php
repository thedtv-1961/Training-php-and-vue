<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Group\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
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

}
