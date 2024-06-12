@extends('layouts.app')


@section('css')
    <!-- BEGIN Page Level CSS-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet">
    <!-- END Page Level CSS-->
@endsection
@section('content')
    <!-- content page title -->
    <div class="container-fluid bg-light-opac">
        <div class="row">
            <div class="container my-3 main-container">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="content-color-primary page-title">Search Results</h2>
                        <p class="content-color-secondary page-sub-title">Search BRT Bus Schedule</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content page title ends -->

    <!-- content page -->
    <div class="container mt-4 main-container">


        <div class="row">
            <div class="col-12 col-md-6">

                <div class="card mb-4 fullscreen">

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

        $(document).ready(function() {

            $('#etaform').on('submit', function(e) {
                e.preventDefault();

                var mdata = $(this).serializeArray(); // convert form to array


                $.ajax({
                    type: "POST",
                    url: '{!! route('geteta') !!}',
                    data: $.param(mdata),
                    beforeSend: function () {
                        $(':button').prop('disabled', true); // Disable all the buttons
                        $(".etabtn").find('i').toggleClass('fa-spinner fa-spin');
                        //var espan = {"name":[""],"state":[""],"lga":[""],"size":[""],"description":[""]};
                        //$.each(espan, function (key, value) {
                        //  $('.'+key+'-error').html(value);
                        //});
                        jQuery("#div-errors").html('');

                    },

                    success:function(response) {
                        if(response.success)
                        {
                           // $(':button').prop('disabled', false); // Enable all the button


                            //toastr.success('Farm added successfully', 'Saved', {positionClass: 'toast-top-right', containerId: 'toast-top-right'});

                            $.toast({
                                heading: 'Success',
                                text: 'Loading route information',
                                position: 'top-right',
                                stack: false,
                                icon: 'success'
                            });

                            setTimeout(function () {
                                // similar behavior as an HTTP redirect
                                //var url = '{{ URL::asset('/ticket/all') }}';
                               window.location.replace(response.url);
                             //   location.reload();
                            }, 2000); //will call the function after 2 secs.



                        }
                        else{
                            $(':button').prop('disabled', false); // Enable all the button


                            $.toast({
                                heading: 'Error',
                                text: 'Please fix the errors on the form',
                                position: 'top-right',
                                stack: false,
                                icon: 'error'
                            });


                            var errorHtml = '';
                            errorHtml+='<div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert"><span class="alert-icon"><i class="la la-warning"></i></span>';
                            errorHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                            //errorHtml+='<h3 class="font-w300 push-15">Please fix the errors on the form</h3>';

                            //errorHtml+='<ul>';

                            var lp = 0;
                            var first_err = 'Something went wrong';

                            $.each(response.errors, function (key, value) {
                                //$('.'+key+'-error').html(value);
                                // errorHtml+='<li>' + value + '</li>';
                                if(lp === 0){
                                    first_err = value;
                                }
                                lp++;

                            });

                            //var req = { mandrill_events: '[{"event":"inbound","ts":1426249238}]' };


                            errorHtml+= ''+ first_err;
                            // errorHtml+='</ul>';
                            errorHtml+='</div>';
                            $( '#div-errors' ).html( errorHtml );
                        }
                        $(".etabtn").find('i').toggleClass('fa-spinner fa-check fa-spin');
                    },
                    error: function(xhr, status, text) {
                        $(':button').prop('disabled', false); // Enable all the button
                        $(".etabtn").find('i').toggleClass('fa-spinner fa-check fa-spin');

                        // check if xhr.status is defined in $.ajax.statusCode
                        // if true, return false to stop this function
                        if (typeof this.statusCode[xhr.status] !== 'undefined') {
                            return false;
                        }
                        // else continue

                        $.toast({
                            heading: 'Warning',
                            text: 'Something went wrong',
                            position: 'top-right',
                            stack: false
                        });


                    },
                    statusCode: {
                        419: function(response) {
                            location.reload();
                        },

                    }


                });
            });


        });


    </script>

@endsection




