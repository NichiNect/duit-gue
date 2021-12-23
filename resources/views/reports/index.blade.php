@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="col-md-12">
            <h2>Graph Summary 2021</h2>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-6 offset-6 text-right">
            <form action="" method="get" class="form-inline">
                <select name="year" id="year" class="form-control text-center content-center mx-2" style="max-width: 80%">
                    @php
                        $years = Helper::getYears();
                    @endphp
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if ($year == date('Y', time())) selected @endif>{{ $year }}</option>
                    @endforeach
                </select>
                <select name="category" id="category" class="form-control mx-2">
                    <option value="" selected disabled>-- Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                <button type="reset" class="btn btn-secondary mx-2">Reset</button>
            </form>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row text-right">
                        <div class="col-lg-12">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-info">
                                  <input type="radio" name="graphtype" value="bar" id="graphtype-bar"> Bar
                                </label>
                                <label class="btn btn-outline-info">
                                  <input type="radio" name="graphtype" value="line" id="graphtype-line"> Line
                                </label>
                            </div>
                        </div>
                    </div>
                    <canvas class="chart" id="chart" data-graphdata="{{ $data }}" data-year="{{ $year }}" data-month=""></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/vendor/chartjs/chartjs.min.js') }}"></script>
<script>
$(document).ready(function(){

    let graphtype = 'bar';
    let graphtypeBar = $('#graphtype-bar');
    let graphtypeLine = $('graphtype-line');

    $('input[type=radio][name=graphtype]').change(function () {
        graphtype = this.value;
        changeChartType(graphtype);
    });

    let reportChart;

    function changeChartType (graphtype) {
        let ctx = $('#chart');
        let data = ctx.data('graphdata');
        let year = ctx.data('year');
        let month = ctx.data('month');

        let income = [];
        let spending = [];
        let arrData = [];

        for (let idx in data) {
            arrData.push(data[idx]);
        }

        arrData.sort((a, b) => {
            return a.month - b.month;
        });

        for (let one of arrData) {
            income.push(one['transaction_in']);
            spending.push(one['transaction_out']);
        }

        let configChart = {
            type: 'bar',
            data: {
                labels: [
                    'January', 'February', 
                    'March', 'April', 
                    'May', 'Juni', 
                    'July', 'August', 
                    'September', 'October', 
                    'November', 'December'
                ],
                datasets: [
                    {
                        label: 'Pemasukan',
                        backgroundColor: 'rgb(28, 186, 70)',
                        borderColor: 'rgb(26, 89, 43)',
                        // data: [0, 10, 25, 2, 20, 30, 45],
                        data: income
                    },
                    {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgb(232, 44, 44)',
                        borderColor: 'rgb(115, 8, 8)',
                        // data: [0, 5, 5, 18, 17, 10, 30],
                        data: spending
                    }
                ]
            },
            options: {
                // scales: {
                //     yAxes: [{
                //         ticks: {
                //             beginAtZero:true
                //         }
                //     }]
                // }
            }
        }


        if (reportChart) {
            reportChart.destroy();
        }

        let temp = $.extend(true, {}, configChart);
        temp.type = graphtype;

        reportChart = new Chart(ctx, temp);
    } 
    
})
</script>
@endsection
