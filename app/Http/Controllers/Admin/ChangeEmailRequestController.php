<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChangeEmailRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChangeEmailRequest\ChangeEmailRequestRepository;

class ChangeEmailRequestController extends Controller
{
    /** 
     * @var ChangeEmailRequestRepository
     * 
    */
    protected $changeEmailRequestRepository;

    /**
     * Create a new controller instance.
     *
     * @param  ChangeEmailRequestRepository  $changeEmailRequestRepository
     * @return void
     */
    public function __construct(ChangeEmailRequestRepository $changeEmailRequestRepository) {
        $this->changeEmailRequestRepository = $changeEmailRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $changeEmailRequests = $this->changeEmailRequestRepository
                                ->orderBy('created_at', 'desc')
                                ->paginate(config('change_email_request.paginate'));

        return view('admin.change_email_request.index', compact('changeEmailRequests'));
    }
}
