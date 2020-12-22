<?php


namespace App\service;


use Carbon\Carbon;
use Mpdf\Mpdf;


class PdfGenerateService
{
    protected const STR = '<table width="100%%"><tr><th align="right"><p>Руководителю университета</p><p>Петру Петровичу Порошенко</p><p>Кафедра "%s"</p><p>от студента</p><p>%s</p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></th></tr><tr><th align="center"><h2>АППЕЛЯЦИЯ</h2><p>Прошу Вас, рассмотреть одно из тестовых заданий по предмету: %s(%s). По следующей причине: %s</p><br><br><br><br><br><br><br><br><br><br><br><br></th></tr><tr><th align="center"><span>Дата : %s</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>Подпись: _________</span></th></tr></table>';
    public function generateSimplePdf() {
        $mpdf = new Mpdf();

        $str = '

        ';

        $frmt = sprintf($str, 'Anvar');
        $mpdf->WriteHTML($str);
        return $mpdf->Output('test.pdf', 'F');
    }

    /**
     * @param $appeal
     * @param $type
     * I - Browser, D - Download, S - String, F - File
     * @return string
     * @throws \Mpdf\MpdfException
     */
    public function generateAppealInFollowingFormat($appeal, $type)
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->getFormattedStringFromModel($appeal));
        return $mpdf->Output('appeal-'. $appeal->id .'.pdf', $type);
    }

    protected function getFormattedStringFromModel($appeal) {
        return sprintf(
           self::STR,
           $appeal->student->department->name,
           $appeal->student->name,
           $appeal->subject->subject_name,
           $appeal->teacher->last_name . ' ' .  $appeal->teacher->first_name,
           $appeal->text,
           Carbon::now()->toDateTimeString()
       );
    }
}
