@extends('layouts.app')

@section('content')

<div class="row p-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Статистика</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <div style="display: flex;justify-content: space-between;">
                    <div style="width: 50%; height: 600px;">
                        <canvas id="myChart" width="300" height="200"></canvas>
                    </div>

                    <div style="width: 50%; height: 600px;">
                        <canvas id="myChart2" width="300" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=QCSg0uAXtICeOAITX8wsBKNmoJOtJF0ZB8rEiPLWbW70krrLlcq73WaCJux3-VocXUisTxFRJ4jwK5XMtmzBnSVhqE5LObEZHK2RLyUGGO2aNF9A9YTbXIYCXSvoEpug4CztBNX8Po1bdTtvGfU3tw" charset="UTF-8"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    var statuses = ['created', 'cancelled', 'waiting', 'on_review', 'accepted'];

    var statusLabels = ['Создано', 'Отменено', 'В ожидании', 'На рассмотрении', 'Принято']

    // Данные с сервера
    var data = {!! json_encode($appeals->toArray()) !!}
    console.log(data)
    // var data = []
    // $.ajax(
    //     {
    //         url: "{{route('stats-json')}}",
    //         // return the result
    //         success: function(result) {
    //             console.log(result)
    //             data = result
    //         },
    //         error: function(jqXHR, testStatus, error) {
    //             console.log(error);
    //         },
    //         timeout: 8000
    //     }
    // )
    // var data = [{ "id": 1, "created_at": "2021-01-21T23:57:45.000000Z", "updated_at": "2021-02-22T01:11:55.000000Z", "text": "Some test text", "status": "created", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 1, "verifier_id": null },
    //     { "id": 2, "created_at": "2020-12-22T00:20:39.000000Z", "updated_at": "2021-01-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "waiting", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-02-22T00:20:39.000000Z", "updated_at": "2021-01-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "on_review", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-01-22T00:20:39.000000Z", "updated_at": "2021-01-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "waiting", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-01-22T00:20:39.000000Z", "updated_at": "2021-01-20T01:11:39.000000Z", "text": "Some test text 22222", "status": "waiting", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-03-22T00:20:39.000000Z", "updated_at": "2020-03-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "waiting", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-03-22T00:20:39.000000Z", "updated_at": "2020-03-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "cancelled", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-03-22T00:20:39.000000Z", "updated_at": "2020-03-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "cancelled", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 2, "created_at": "2021-03-22T00:20:39.000000Z", "updated_at": "2021-03-22T01:11:39.000000Z", "text": "Some test text 22222", "status": "cancelled", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null },
    //     { "id": 3, "created_at": "2020-12-22T01:05:14.000000Z", "updated_at": "2021-02-22T01:09:20.000000Z", "text": "test test test", "status": "cancelled", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null }, { "id": 4, "created_at": "2020-12-22T02:01:34.000000Z", "updated_at": "2020-12-22T02:03:05.000000Z", "text": "Фыаывафв", "status": "accepted", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 3, "verifier_id": null }, { "id": 5, "created_at": "2020-12-22T14:29:30.000000Z", "updated_at": "2020-12-22T14:30:42.000000Z", "text": "Текст заявления", "status": "accepted", "subject_id": 1, "teacher_id": 1, "department_id": 1, "student_id": 7, "verifier_id": null }]

    var initData = statuses.reduce((acc, cur) =>  ({...acc, [cur]: 0 }), {})

    data.forEach(d => {
        initData[d.status]++
    })

    var monthNames = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
        "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
    ];

    var dates = data.map(d => ({date: d['updated_at'], status: d.status}))
        .map(d => ({...d, date: new Date(d.date)}))
        .filter(d => d.date.getFullYear() === new Date().getFullYear())
        .map(d => ({ ...d, date: d.date.getMonth()}))

    dates.forEach(date => {
        console.log(initData[date])
    })

    var _initData2 = {}

    dates.forEach(date => {
        _initData2[date.date] = {}
        _initData2[date.date] = 0

    })

    var initData2 = []

    Object.keys(_initData2).forEach(key => {
        initData2[key] = {
            created: 0,
            cancelled: 0,
            waiting: 0,
            on_review: 0,
            accepted: 0
        }
    })

    dates.forEach(date => {
        initData2[date.date][date.status]++
    })

    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            label: "",
            labels: statusLabels,
            datasets: [{
                data: statuses.map(status => initData[status]),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: null,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        }
    });

    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            label: "",
            labels: Object.keys(initData2).map(key => monthNames[key]),
            datasets:
                [
                    {
                        data: initData2.map(o => o.accepted),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        fill: false,
                        label: 'Принято'
                    },
                    {
                        data: initData2.map(o => o.cancelled),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        label: 'Отменено',
                        fill: false
                    },
                    {
                        data: initData2.map(o => o.created),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        label: "Создано",
                        fill: false
                    },
                    {
                        data: initData2.map(o => o.on_review),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        label: "На рассмотрении",
                        fill: false
                    },
                    {
                        data: initData2.map(o => o.waiting),
                        borderColor: 'rgba(255, 206, 86, 1)',
                        label: "В ожидании",
                        fill: false
                    }]
        },
        options: {
            legend: {
                display: true
            },
            suggestedMin: 0,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,

                    }
                }]
            }
        }
    });
</script>
@endsection
