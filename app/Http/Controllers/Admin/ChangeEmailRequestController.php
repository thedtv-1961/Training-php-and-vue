<?php
namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Events\UserNotification;
use App\Jobs\SendChangeEmailRequest;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Repositories\User\UserRepository;
use App\Repositories\ChangeEmailRequest\ChangeEmailRequestRepository;

class ChangeEmailRequestController extends Controller
{
    /**
     * @var ChangeEmailRequestRepository
     *
    */
    protected $changeEmailRequestRepository;

    /**
     * @var UserRepository
     *
    */
    protected $userRepository;

    /**
     * @var NotificationService
     *
    */
    protected $notificationService;

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
        UserRepository $userRepository,
        NotificationService  $notificationService
    ) {
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
        $this->authorize('approveChangeEmail', auth()->user());
        DB::beginTransaction();
        try {

            if ($request->status == config('change_email_requests.status.approved')) {
                $changeEmailRequest = $this->changeEmailRequestRepository
                                        ->update($id, ['status' => $request->status, 'admin_id' => Auth::user()->id]);
                $listUser = $this->userRepository->pluck('email')->toArray();
                $emailChange = $changeEmailRequest->email_change;
                if (in_array($emailChange, $listUser)) {
                    return back()
                        ->withInput()
                        ->with('message_class', 'danger')
                        ->with('message', trans('change_email_requests.index.email_existed'));
                } else {
                    $oldEmail = $changeEmailRequest->user->email;
                    $user = $changeEmailRequest->user->update(['email' => $emailChange]);
                    $this->dispatch(new SendChangeEmailRequest(config('change_email_requests.mail_type.approve'), $oldEmail, trans('change_email_requests.mail_title.approve'), $changeEmailRequest->user));
                    $this->dispatch(new SendChangeEmailRequest(config('change_email_requests.mail_type.approve'), $emailChange, trans('change_email_requests.mail_title.approve'), $changeEmailRequest->user));
                }
            } else {
                $changeEmailRequest = $this->changeEmailRequestRepository
                    ->update($id, ['status' => $request->status, 'admin_id' => Auth::user()->id]);
                $this->dispatch(new SendChangeEmailRequest(config('change_email_requests.mail_type.reject'), $changeEmailRequest->user->email, trans('change_email_requests.mail_title.reject'), $changeEmailRequest->user));

            }
            $message = $request->status == config('change_email_requests.status.approved') ? 'approved' : 'rejected';
            $notificationContent = $this->notificationService
                ->getContentNotification($message, $changeEmailRequest->user_id);
            event(new UserNotification($notificationContent, $changeEmailRequest->user_id));
            DB::commit();
            return back()
                    ->withInput()
                    ->with('message_class', 'success')
                    ->with('message', trans('change_email_requests.index.successfully_updated'));
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollback();
            return back()
                ->withInput()
                ->with('message_class', 'danger')
                ->with('message', trans('change_email_requests.index.update_fail'));
        }
    }
}
