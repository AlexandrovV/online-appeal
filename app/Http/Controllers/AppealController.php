<?php

namespace App\Http\Controllers;

use App\Mail\AppealMail;
use App\Mail\ProtocolMail;
use App\Mail\TestMail;
use App\Models\Appeal;
use App\Models\Approval;
use App\Models\Subject;
use App\Models\Teacher;
use App\repository\AppealRepository;
use App\repository\ApprovalRepository;
use App\repository\NotificationLogRepository;
use App\service\PdfGenerateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AppealController extends Controller
{
    protected $repository;
    protected $approvalRepository;
    protected $generateService;
    protected $notificationLogRepository;

    public function __construct(AppealRepository $repository, ApprovalRepository $approvalRepository,
                                PdfGenerateService $generateService, NotificationLogRepository $notificationLogRepository)
    {
        $this->repository = $repository;
        $this->approvalRepository = $approvalRepository;
        $this->generateService = $generateService;
        $this->notificationLogRepository = $notificationLogRepository;
    }

    public function form() {
        $user = Auth::user();
        $department = $user->department;
        $subjects = Subject::where('department_id', $department->id)->first();
        $teachers = Teacher::where('department_id', $department->id)->first();
        return view('appeal.form', compact('department', 'teachers', 'subjects'));
    }

    public function findAllJson() {
        return response()->json($this->repository->findAll());
    }

    public function create(Request $request) {
        try {
            $this->repository->save(Auth::user()->id, $request['departmentId'], $request['subjectId'], $request['teacherId'], $request['text']);
            return redirect()->route('appeal-form')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('appeal-form')->with('status', 'fail');
        }
    }

    public function studentAppeals() {
        $user = Auth::user();
        $appeals = $this->repository->studentsAppeals($user->id, null);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function studentStatusAppeals($status) {
        $user = Auth::user();
        $appeals = $this->repository->studentsAppeals($user->id, $status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function managerAppeals() {
        $appeals = $this->repository->managerAppeals(null);

        foreach ($appeals as $appeal) {
            $appeal['can_process'] = true;
            foreach ($appeal->approvals as $approval) {
                if ($approval->manager_id == Auth::user()->id) {
                    $appeal['can_process'] = false;
                    break;
                }
            }
        }
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function managerStatusAppeals($status) {
        $appeals = $this->repository->managerAppeals($status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function departmentAppeals() {
        $user = Auth::user();
        $appeals = $this->repository->departmentAppeals($user->department_id, null);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function departmentStatusAppeals($status) {
        $user = Auth::user();
        $appeals = $this->repository->departmentAppeals($user->department_id, $status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function managerProcessAppeal(Request $request) {
        try {
            $status = $request['status'];
            if ($status == 'accepted') {
                $this->approvalRepository->save(Auth::user()->id, $request['appealId'], $request['comment'], 'accepted');
                if ($this->approvalRepository->hasEnoughApprovals($request['appealId'])) {
                    $this->repository->accept($request['appealId']);
                    $appeal = Appeal::where('id', $request['appealId'])->first();
                    $this->generateService->generateProtocol($appeal, 'F');

                    $emails = array();
                    foreach ($appeal->approvals as $approval) {
                        array_push($emails, $approval->manager->email);
                    }
                    foreach ($emails as $recipient) {
                        Mail::to($recipient)->send(new ProtocolMail($appeal));
                        $this->notificationLogRepository->save("appeal mail", $recipient, "SMTP");
                    }
                }
            } else {
                $this->approvalRepository->save(Auth::user()->id, $request['appealId'], $request['comment'], 'declined');
                $this->repository->cancel($request['appealId']);
            }

            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->back()->with('status', 'fail');
        }
    }

    public function approve($id) {
        try {
            $this->repository->approve($id);
            $appeal = Appeal::where('id', $id)->first();
            $this->generateService->generateAppealInFollowingFormat($appeal, 'F');
            $this->sendConfirmedAppeal($id);
            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->back()->with('status', 'fail');
        }
    }

    public function cancel($id) {
        try {
            $this->repository->cancel($id);
            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->back()->with('status', 'fail');
        }
    }

    public function getAppealInBrowser($id) {
        $appeal = Appeal::query()->findOrFail($id);
        $doc =  $this->generateService->generateAppealInFollowingFormat($appeal, 'I');
    }

    private function sendConfirmedAppeal($id) {
        $appeal = Appeal::query()->findOrFail($id);
        $email = $appeal->student->email;
        foreach ([$email] as $recipient) {
            Mail::to($recipient)->send(new AppealMail($appeal));
            $this->notificationLogRepository->save("appeal mail", $email, "SMTP");
        }
    }
}
