<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\repository\DepartmentRepository;
use App\repository\NotificationLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationLogController extends Controller
{
    protected $repository;

    public function __construct(NotificationLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $notifications = $this->repository->findAll();
        return view('notification.index', compact('notifications'));
    }

}
