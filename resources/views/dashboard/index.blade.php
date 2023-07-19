@extends('layout.dashboard')

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
    </div>
    <section class="section">
        <div class="row mb-2">
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>BALANCE</h3>
                            </div>
                            <div class="chart-wrapper p-3">
                                @php
                                    $balance = \App\Models\Order::where('status', 'finished')->sum('total');
                                @endphp
                                <span style="height:100px !important">
                                    <h4 style="color: white">Rp. {{ number_format($balance, 0, ',', '.') }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>ORDERS</h3>
                            </div>
                            <div class="chart-wrapper p-3">
                                @php
                                    $orders = \App\Models\Order::count();
                                @endphp
                                <span style="height:100px !important">
                                    <h4 style="color: white">{{ $orders }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Users</h3>
                            </div>
                            <div class="chart-wrapper p-3">
                                @php
                                    $users = \App\Models\User::count();
                                @endphp
                                <span style="height:100px !important">
                                    <h4 style="color: white">{{ $users }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between'>
                                <h3 class='card-title'>Sales Today</h3>
                            </div>
                            <div class="chart-wrapper p-3">
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $sales = \App\Models\Order::where('status', 'paid')
                                                ->whereDate('updated_at', $today)
                                                ->count();
                                @endphp
                                <span style="height:100px !important">
                                    <h4 style="color: white">{{ $sales }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class='card-heading p-1 pl-3'>Sales</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="pl-3">
                                    <h2 class='mt-5'>Rp. {{ number_format($thisMonth, 0, ',', '.') }}</h2>
                                    @php
                                        if ($lastMonth !== 0) {
                                            $percentage = ($thisMonth - $lastMonth) / abs($lastMonth) * 100;
                                        } else {
                                            $percentage = 0;
                                        }
                                    @endphp
                                    <p class='text-xs'><span class="text-green"><i data-feather="bar-chart" width="15"></i> {{ $percentage >= 0 ? '+' : ''}}{{ number_format($percentage, 2) }}%</span> than last month</p>
                                    <div class="legends">
                                        <div class="legend d-flex flex-row align-items-center">
                                            <div class='w-3 h-3 rounded-full bg-blue me-2'></div><span class='text-xs'>Current Month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-12">
                                <canvas id="bar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        info: '#41B1F9',
        blue: '#3245D1',
        purple: 'rgb(153, 102, 255)',
        grey: '#EBEFF6'
    };

    var ctxBar = document.getElementById("bar").getContext("2d");
    var orderData = JSON.parse('{!! json_encode($orderData) !!}');
    console.log(orderData)
    var labels = orderData.map(order => order.date); 
    var counts = orderData.map(order => order.count);
    var myBar = new Chart(ctxBar, {
    type: 'bar',
    data: {
            labels: labels,
            datasets: [{
                label: 'Order Count',
                data: counts,
                backgroundColor: chartColors.blue,
                barPercentage: 0.3,
                categoryPercentage: 0.3
            }]
        },
    options: {
        responsive: true,
        barRoundness: 1,
        title: {
        display: false,
        text: "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)"
        },
        legend: {
        display:false
        },
        scales: {
        yAxes: [{
            ticks: {
            beginAtZero: true,
            suggestedMax: 40 + 20,
            padding: 10,
            },
            gridLines: {
            drawBorder: false,
            }
        }],
        xAxes: [{
                gridLines: {
                    display:false,
                    drawBorder: false
                }
            }]
        }
    }
    });

</script>

@endsection