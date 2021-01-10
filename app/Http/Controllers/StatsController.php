<?php

namespace App\Http\Controllers;

use App\repository\AppealRepository;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    protected $appealsRepository;

    public function __construct(AppealRepository $appealsRepository)
    {
        $this->appealsRepository = $appealsRepository;
    }

    public function index() {
        $appeals = $this->appealsRepository->findAll();
        return view('stats.index', compact('appeals'));
    }
}
