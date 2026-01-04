@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ Auth::guard('admin')->user()->first_name }}'s Dashboard</h1>
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div> --}}
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col text-center">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $activeUsers->count }}</h3>
                                <p>Active Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('users.read')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col text-center">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $childrenRecords->count }}</h3>
                                <p>Children Records</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('children.read')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $courtHearings->count }}</h3>
                                <p>Court Appointments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('court-appointments.index')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col text-center">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $groups->count }}</h3>
                                <p>Groups</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('children-group.read')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <div class="card card-primary">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <div class="card card-primary">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="card card-primary">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-between m-2">
            </div>

              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

              <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                      label: '# of Admissions',
                      data: [{{ $doaChart[0] }}, {{ $doaChart[1] }}, {{ $doaChart[2] }}, {{ $doaChart[3] }}, {{ $doaChart[4] }}, {{ $doaChart[5] }}, {{ $doaChart[6] }}, {{ $doaChart[7] }}, {{ $doaChart[8] }}, {{ $doaChart[9] }}, {{ $doaChart[10] }}, {{ $doaChart[11] }}],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>
              <script>
                const ctx2 = document.getElementById('myChart2');

                new Chart(ctx2, {
                  type: 'bar',
                  data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                      label: '# of Court Hearings',
                      data: [{{ $doaChart2[0] }}, {{ $doaChart2[1] }}, {{ $doaChart2[2] }}, {{ $doaChart2[3] }}, {{ $doaChart2[4] }}, {{ $doaChart2[5] }}, {{ $doaChart2[6] }}, {{ $doaChart2[7] }}, {{ $doaChart2[8] }}, {{ $doaChart2[9] }}, {{ $doaChart2[10] }}, {{ $doaChart2[11] }}],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>
              <script>
                const ctx3 = document.getElementById('myChart3');

                new Chart(ctx3, {
                  type: 'bar',
                  data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                      label: '# of Medical Appointments',
                        data: [{{ $doaChart2[0] }}, {{ $doaChart2[1] }}, {{ $doaChart2[2] }}, {{ $doaChart2[3] }}, {{ $doaChart2[4] }}, {{ $doaChart2[5] }}, {{ $doaChart2[6] }}, {{ $doaChart2[7] }}, {{ $doaChart2[8] }}, {{ $doaChart2[9] }}, {{ $doaChart2[10] }}, {{ $doaChart2[11] }}],
                        borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>

            {{-- <div class="card card-danger">
                <canvas id="myChart"></canvas>
            </div> --}}

              {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
