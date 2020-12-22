<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\service\PdfGenerateService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $pdfService;


    /**
     * TestController constructor.
     * @param $pdfService
     */
    public function __construct(PdfGenerateService $pdfService)
    {
        $this->pdfService = $pdfService;
    }


    public function indexTest() {
        $file = $this->pdfService->generateSimplePdf();

        return view('test.login');
    }

}
