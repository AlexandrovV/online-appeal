<?php


namespace App\service;


use Mpdf\Mpdf;


class PdfGenerateService
{
    protected const STR = '
        <table width="100%">
            <tr>
                <th align="right">
                    <p>Руководителю университета</p>
                    <p>Имя Фамилия Отчество</p>
                    <p>от студента Название кафедры</p>
                    <p>Имя Фамилия Отчество</p>
                    <br><br><br><br><br><br><br><br>
                    <br><br><br><br><br><br><br><br>
                </th>
            </tr>
            <tr>

                <th align="center">
                    <h2>АППЕЛЯЦИЯ</h2>
                    <p>Прошу Вас, рассмотреть одно из тестовых заданий по предмету: НАЗВАНИЕ ПРЕДМЕТА (ПРЕПОДАВАТЕЛЬ). По следующей причине: ПРИЧИНА</p>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </th>
            </tr>

            <tr>
                <th align="center">
                    <span>Дата : ЧИСЛО</span>
                    <span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                    <span>Подпись: ФАМИЛИЯ И. О.</span>
                </th>
            </tr>
        </table>
    ';
    public function generateSimplePdf() {
        $mpdf = new Mpdf();

        $str = '

        ';

        $frmt = sprintf($str, 'Anvar');
        $mpdf->WriteHTML($str);
        return $mpdf->Output('test.pdf', 'F');
    }
}
