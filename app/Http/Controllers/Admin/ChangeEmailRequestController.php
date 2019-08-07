<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\Models\ChangeEmailRequest;
use Illuminate\Http\Request;
use App\Events\UserNotification;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Repositories\User\UserRepository;
use App\Repositories\ChangeEmailRequest\ChangeEmailRequestRepository;

class ChangeEmailRequestController extends Controller
{
    /**
     * @var ChangeEmailRequestRepository
     * @var UserRepository
     * @var NotificationService
     *
    */
    protected $changeEmailRequestRepository, $userRepository, $notificationService;

    /**
     * Create a new controller instance.
     *
     * @param  ChangeEmailRequestRepository  $changeEmailRequestRepository
     * @param  UserRepository  $userRepository
     * @param  NotificationService  $notificationService
     * @return void
     */
    public function __construct(
        ChangeEmailRequestRepository $changeEmailRequestRepository,
        UserRepository $userRepository, NotificationService  $notificationService) {
        $this->changeEmailRequestRepository = $changeEmailRequestRepository;
        $this->userRepository = $userRepository;
        $this->notificationService = $notificationService;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request  $request)
    {
        DB::beginTransaction();
        try {
            if ($request->status == config('change_email_requests.status.approved')) {
                $changeEmailRequest = $this->changeEmailRequestRepository
                                        ->update($id, ['status' => $request->status, 'admin_id' => Auth::user()->id]);
                $listUser = $this->userRepository->pluck('email')->toArray(); ;

                $emailChange = $changeEmailRequest->email_change;

                if (in_array($emailChange, $listUser)) {

                    return back()
                        ->withInput()
                        ->with('message_class', 'danger')
                        ->with('message', trans('change_email_requests.index.email_existed'));
                } else {
                    $user = $changeEmailRequest->user->update(['email' => $emailChange]);
                }
            } else {
                $changeEmailRequest = $this->changeEmailRequestRepository
                                        ->update($id, ['status' => $request->status, 'admin_id' => Auth::user()->id]);

            }
            $message = $request->status == config('change_email_requests.status.approved') ? 'approved' : 'rejected';
            $notificationContent = $this->notificationService->getContentNotification($message, $changeEmailRequest->user_id);
            event(new UserNotification($notificationContent, $changeEmailRequest->user_id));
            DB::commit();

            return back()
                    ->withInput()
                    ->with('message_class', 'success')
                    ->with('message', trans('change_email_requests.index.successfully_updated'));
        } catch (\Exception $exception) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('message_class', 'danger')
                ->with('message', trans('change_email_requests.index.update_fail'));
        }
    }
}
