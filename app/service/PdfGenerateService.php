<?php


namespace App\service;


use Carbon\Carbon;
use Mpdf\Mpdf;


class PdfGenerateService
{
    protected const STR = '<table width="100%%"><tr><th align="right"><p>Руководителю университета</p><p>Петру Петровичу Порошенко</p><p>Кафедра "%s"</p><p>от студента</p><p>%s</p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></th></tr><tr><th align="center"><h2>АППЕЛЯЦИЯ</h2><p>Прошу Вас, рассмотреть одно из тестовых заданий по предмету: %s(%s). По следующей причине: %s</p><br><br><br><br><br><br><br><br><br><br><br><br></th></tr><tr><th align="center"><span>Дата : %s</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>Подпись: _________</span></th></tr></table>';
    protected const PROTOCOL_STR_PART_1 = '<table width="100%%">
    <tr>
        <th align="center"><p>АО "МУИТ"</p>
            <p>ПРОТОКОЛ № %s</p>
            <p>совещание менеджеров учебной комиссии</p>
        </th>
    </tr>
    <tr>
        <th align="center"><span>Дата : %s</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>г. Алматы</span>
        </th>
    </tr>
    <tr>
        <th align="left">
            <p>Об изменении статуса аппеляции № %s</p>
            <br><br><br><br>
            <p>ПОВЕСТКА ДНЯ:</p>
            <p>1. Определение статуса текущей заявки:</p>
            <br><br><br><br>
            <p>ПОСТАНОВИЛИ:</p>
            <p>1. Изменить статус заявки на успешный и передать на дальнейшее ислледование кафедре</p>
            <br><br><br><br>
            <p>Голосование: Проголосовавшие "За" указаны в списке ниже:</p>';
    protected const PROTOCOL_STR_PART_2 = '</th></tr></table>';
    protected const PROTOCOL_STR_IMPORT = '<p>%s<span>&nbsp;&nbsp;&nbsp;Подпись: __________</span></p>';
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

    public function generateProtocol($appeal, $type) {
        $mpdf = new Mpdf();
        $html = sprintf(
            self::PROTOCOL_STR_PART_1,
            $appeal->id,
            Carbon::now()->toDateTimeString(),
            $appeal->id,
        ); //approvals
        foreach ($appeal->approvals as $approval) {
            $html .= sprintf(self::PROTOCOL_STR_IMPORT, $approval->manager->name);
        }
        $html .= self::PROTOCOL_STR_PART_2;
        $mpdf->WriteHTML($html);
        return $mpdf->Output('protocol-'. $appeal->id .'.pdf', $type);
    }
}
