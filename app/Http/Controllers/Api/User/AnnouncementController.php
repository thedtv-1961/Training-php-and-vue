<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Announcement\AnnouncementInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnnouncementController extends Controller
{

    /**
     * @var  announcementRepository
     *
    */
    protected $announcementRepository;

    /**
     * Create a new controller instance.
     *
     * @param  AnnouncementInterface  $announcementRepository
     *
     * @return void
     */
    public function __construct(AnnouncementInterface $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupIds = auth()->user()->groups->pluck('id')->all();
        $annoncements = $this->announcementRepository->whereIn('group_id', $groupIds)->get();

        return response()->json($annoncements);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $annoncement = $this->announcementRepository->findOrFail($id);

            return response()->json($annoncement);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
                'error_code' => 404,
            ]);
        }
    }
}
