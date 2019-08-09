<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeEmail;
use App\Models\ChangeEmailRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @param  App\Http\Requests\ChangeEmail  $request
     * @return \Illuminate\Http\Response
     */
    public function changeEmailRequest(ChangeEmail $request)
    {
        try {
            $changeEmailRequests = $this->changeEmailRequestRepository
                                    ->create([
                                        'email_change' => $request->email_change,
                                        'status' => 0,
                                        'user_id' => $request->user_id,
                                    ]);

            return response()->json($changeEmailRequests);
        } catch (Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                $errorCode = 404;
            } else {
                $errorCode = 500;
            }

            return response()->json([
                'error_message' => $e->getMessage(),
                'error_code' => $errorCode,
            ]);
        }
    }
}
