@extends('staff.layout')
@section('title', 'Test')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ Auth::user()->first_name }}'s Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$childrenRecords}}</h3>
                                <p>Children Records</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('staff.children.read') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>


                        <div class="card card-light">
                            <div class="card-header">
                                <h3>Children Groups</h3>
                                {{-- <p>Upcoming Court Hearings</p> --}}
                            </div>
                            <div class="card-body">
                                @forelse($childrenGroup as $item)
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                        <h3>{{$item->name}}</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="{{route('staff.children.group-read', $item->id)}}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                @empty
                                <h3>There are no groups assigned to you.</h3>
                                @endforelse
                            </div>

                        </div>

                    </div>

                    {{-- <div class="col">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>20</h3>
                                <p>Appointments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('head.appointments.read') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}

                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Upcoming Appointments</h3>
                                {{-- <p>Upcoming Court Hearings</p> --}}
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    @forelse($appointments as $item)
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapse{{$item->id}}"
                                                        aria-expanded="true">
                                                       {{ date('l jS \of F Y h:i A', strtotime($item->appointment_date)) }} - {{ $item->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse{{$item->id}}" class="collapse show" data-parent="#accordion"
                                                style="">
                                                <div class="card-body">
                                                     <h3>Case: {{$item->child_id}} - {{$item->children?->first_name}} {{$item->children?->lastname}}</h3>
                                                     <br>
                                                     {{$item->details}}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card card-primary m-3">
                                            <div class="card-body">
                                                <h1>There are no appointments</h1>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row d-flex justify-content-between m-2">
            </div>

            <div class="card card-danger">
                <canvas id="myChart"></canvas>
            </div>

              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

              <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: {!! json_encode($datasets) !!},
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script> --}}

        </section>

    </div>

    {{-- <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type = 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: {!! json_encode($datasets) !!},
            },
        })
    </script> --}}

    {{-- <script>
        $(function()) {
                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData = {
                    labels: [
                        'Chrome',
                        'IE',
                        'FireFox',
                        'Safari',
                        'Opera',
                        'Navigator',
                    ],
                    datasets: [{
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = donutData;
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                })

                //-------------
                //- BAR CHART -
                //-------------
                // var barChartCanvas = $('#barChart').get(0).getContext('2d')
                // var barChartData = $.extend(true, {}, areaChartData)
                // var temp0 = areaChartData.datasets[0]
                // var temp1 = areaChartData.datasets[1]
                // barChartData.datasets[0] = temp1
                // barChartData.datasets[1] = temp0

                // var barChartOptions = {
                //     responsive: true,
                //     maintainAspectRatio: false,
                //     datasetFill: false
                // }

                // new Chart(barChartCanvas, {
                //     type: 'bar',
                //     data: barChartData,
                //     options: barChartOptions
                // })
    </script> --}}
    }
@endsection
