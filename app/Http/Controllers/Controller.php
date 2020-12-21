<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    protected $service;
//    protected $repository;
//
//    public function __construct(SourceService $sourceService, SourceRepository $sourceRepository) {
//        $this -> service = $sourceService;
//        $this -> repository = $sourceRepository;
//    }


}
