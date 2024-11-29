@extends('head.layout')
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
                                <h3>{{ $childrenRecords->count }}</h3>
                                <p>Children Records</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('head.children.read') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col">

                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $courtHearings->count }}</h3>
                                <p>Court Appointments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('head.appointments.read') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $groups->count }}</h3>
                                <p>Groups</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('head.children-group.read') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Upcoming Court Hearings</h3>
                                {{-- <p>Upcoming Court Hearings</p> --}}
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    @forelse($appointments as $item)
                                        {{-- <div class="card card-primary m-3">
                                            <div class="card-body">
                                                <p>{{ $item->appointment_date }}</p>
                                                <p>{{ $item->title }}</p>
                                            </div>
                                        </div> --}}
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
                                                    {{$item->details}}
                                                    <br>
                                                    <p>Required Documents:</p>
                                                    @if($item->csf == '1')
                                                        <div class="">
                                                            <label>Case Study Report</label>&emsp;
                                                            <input type="checkbox" name="csf" class="form-check-input ml-2" value="1" disabled {{($item->children?->csf) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->poe == '1')
                                                        <div class="">
                                                            <label>Proof of Efforts</label>&emsp;
                                                            <input type="checkbox" name="poe" class="form-check-input ml-2" value="1" disabled {{($item->children?->poe) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->cof == '1')
                                                        <div class="">
                                                            <label>Certificate of Foundling</label>&emsp;
                                                            <input type="checkbox" name="cof" class="form-check-input ml-2" value="1" disabled {{($item->children?->cof) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->cola == '1')
                                                        <div class="">
                                                            <label>Certificate for Legal Adoption</label>&emsp;
                                                            <input type="checkbox" name="cola" class="form-check-input ml-2" value="1" disabled {{($item->children?->cola) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->cfsc == '1')
                                                        <div class="">
                                                            <label>Certificate of Voluntarily Committed/Surrendered Child</label>&emsp;
                                                            <input type="checkbox" name="cfsc" class="form-check-input ml-2" value="1" disabled {{($item->children?->cfsc) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->bc == '1')
                                                        <div class="">
                                                            <label>Birth Certificate</label>&emsp;
                                                            <input type="checkbox" name="bc" class="form-check-input ml-2" value="1" disabled {{($item->children?->bc) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->admission_photo == '1')
                                                        <div class="">
                                                            <label>Photo of Child from Admission</label>&emsp;
                                                            <input type="checkbox" name="admission_photo" class="form-check-input ml-2" value="1" disabled {{($item->children?->admission_photo) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
                                                    @if($item->latest_photo == '1')
                                                        <div class="">
                                                            <label>Latest Photo of Child</label>&emsp;
                                                            <input type="checkbox" name="latest_photo" class="form-check-input ml-2" value="1" disabled {{($item->children?->latest_photo) ? 'checked' : ''}}>
                                                        </div>
                                                    @endif
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
                    <div class="col col-lg-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3>Eligible Cases for Petition</h3>
                                {{-- <p>Upcoming Court Hearings</p> --}}
                            </div>
                            <div class="card-body">
                                <div id="accordion">
                                    @forelse($eligible as $item)
                                        {{-- <div class="card card-primary m-3">
                                            <div class="card-body">
                                                <p>{{ $item->appointment_date }}</p>
                                                <p>{{ $item->title }}</p>
                                            </div>
                                        </div> --}}
                                        @if(\Carbon\Carbon::now()->diffInMonths($item->doa) <= -3)
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100">
                                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseEligible{{$item->id}}"
                                                            aria-expanded="true">
                                                            Case: {{$item->id}} - {{$item->first_name}} {{$item->lastname}}
                                                            {{-- {{ date('l jS \of F Y h:i A', strtotime($item->appointment_date)) }} - {{ $item->title }} --}}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseEligible{{$item->id}}" class="collapse show" data-parent="#accordion"
                                                    style="">
                                                    <div class="card-body">
                                                        <p>Documents at hand:</p>
                                                        @if($item->csf != null)
                                                            <div class="">
                                                                <label>Case Study Report</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->poe != null)
                                                            <div class="">
                                                                <label>Proof of Efforts</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->cof != null)
                                                            <div class="">
                                                                <label>Certificate of Foundling</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->cola != null)
                                                            <div class="">
                                                                <label>Certificate for Legal Adoption</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->cfsc != null)
                                                            <div class="">
                                                                <label>Certificate of Voluntarily Committed/Surrendered Child</label>
                                                            </div>
                                                        @endif
                                                        @if($item->bc != null)
                                                            <div class="">
                                                                <label>Birth Certificate</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->admission_photo != null)
                                                            <div class="">
                                                                <label>Photo of Child from Admission</label>&emsp;
                                                            </div>
                                                        @endif
                                                        @if($item->latest_photo != null)
                                                            <div class="">
                                                                <label>Latest Photo of Child</label>&emsp;
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
