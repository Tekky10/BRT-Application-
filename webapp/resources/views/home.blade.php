@extends('layouts.app')

@section('content')
    <!-- content page title -->
    <div class="container-fluid bg-light-opac">
        <div class="row">
            <div class="container my-2 main-container">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="content-color-primary page-title">Dashboard</h2>
                        <p class="content-color-secondary page-sub-title">Welcome, {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-auto">
                        <a href="{{url("/brteta")}}" class="btn btn-rounded pink-gradient text-uppercase"><i class="material-icons">directions_bus</i> <span>BRT ETA</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content page title ends -->

    <!-- content page -->
    <div class="container mt-2 main-container">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="icon-rounded icon-50 shadow-light primary-gradient top-right-icon">
                            <i class="material-icons">directions_bus</i>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <p class="content-color-secondary mb-0">Total Buses</p>
                                <h4 class="content-color-primary mb-3">40 <small class="content-color-secondary">buses</small></h4>
                            </div>
                        </div>
                        <div class="progress progress-small">
                            <div class="progress-bar bg-primary col-4" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="icon-rounded icon-50 shadow-light primary-gradient top-right-icon">
                            <i class="material-icons">map</i>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <p class="content-color-secondary mb-0">Total Routes</p>
                                <h4 class="content-color-primary mb-3">8 <small class="content-color-secondary">Bus Stops</small></h4>
                            </div>
                        </div>
                        <div class="progress progress-small">
                            <div class="progress-bar bg-primary col-4" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">

                <div class="card mb-4 fullscreen">
                    <div class="card-header">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="content-color-primary mb-0">BRT Schedule</h4>
                            </div>
                            <a href="javascript:void(0);" class="icon-circle icon-30 content-color-secondary fullscreenbtn">
                                <i class="material-icons ">crop_free</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table border-bottom mb-0 footable">
                            <thead class="d-none">
                            <tr>
                                <th>Bus Routes</th>
                                <th data-breakpoints="xs">Seats</th>
                                <th data-breakpoints="xs sm">Fare</th>
                                <th data-breakpoints="xs sm">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    <div class="media">

                                        <div class="icon-circle icon-50 bg-light-primary mr-3">
                                            <i class="material-icons">directions_bus</i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="my-0 mt-1">{{$schedule->time_from}} - {{$schedule->time_to}}</h6>
                                            <p class="small">{{$schedule->location_from}} - {{$schedule->location_to}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6 class="my-0 mt-1">{{$schedule->seat}}</h6>
                                    <p class="content-color-secondary small mb-0">Seats</p>
                                </td>
                                <td>
                                    <h6 class="my-0 mt-1">&#8358;{{$schedule->price}}</h6>
                                    <p class="content-color-secondary small mb-0">Fare</p>
                                </td>
                                <td class="text-right">
                                    <a href="{{url("/book/".$schedule->id)}}" class="btn pink-gradient px-3 btn-sm">Book</a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content page ends -->

@endsection

@section('js')
    <script>
        /* footable  */
        $(".footable").footable({
            "paging": {
                "enabled": true,
                "position": "center"
            }
        });

    </script>
@endsection




