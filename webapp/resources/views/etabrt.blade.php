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
                        <h2 class="content-color-primary page-title">BRT Time of Arrival</h2>
                        <p class="content-color-secondary page-sub-title">Estimated Bus Arrival Time</p>
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
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="col">
                            <span> Departure: {{$departure->name}}</span></br>
                            <span> Arrival: {{$arrival->name}}</span></br>
                            <span> Distance: {{ $eta->distance }} KM</span></br>
                            <span> ETA: {{ $eta->time }} </span>

                        </div>

                    </div>
                </div>
            </div>

            @if(!$brtroutes->isEmpty())
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="mb-0">Bus Stops</h4>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush w-100 log-information mt-3">
                            @foreach($brtroutes as $brtroute )
                            <li class="list-group-item">
                                <span class="avatar avatar-15 border-success"></span>
                                <p class="content-color-primary">{{$brtroute->name}}
                                    <!--
                                    <br><small class="content-color-secondary">2:02 am</small></p>
                                -->
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
            @endif
        </div>



    </div>
    <!-- content page ends -->





@endsection

@section('js')

    <script>
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
                            $(':button').prop('disabled', false); // Enable all the button


                            //toastr.success('Farm added successfully', 'Saved', {positionClass: 'toast-top-right', containerId: 'toast-top-right'});

                            //setTimeout(function () {
                                // similar behavior as an HTTP redirect
                                //var url = '{{ URL::asset('/ticket/all') }}';
                                //window.location.replace(url);
                             //   location.reload();
                            //}, 2000); //will call the function after 2 secs.



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




