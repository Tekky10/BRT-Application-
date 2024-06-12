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
                        <h2 class="content-color-primary page-title">BRT ETA</h2>
                        <p class="content-color-secondary page-sub-title">Estimate Time of Arrival</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content page title ends -->

    <!-- content page -->
    <div class="container mt-4 main-container">
        <div class="card mb-4">
            <form id="etaform" method="POST" action="{{ route('geteta') }}">



            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-10 mx-auto">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 text-center">
                                <img src="{{asset("img/logo.png")}}" alt="" class="mt-4">
                                <br>
                                <h5 class="mt-4">Get Estimated Time of Arrival   </h5>
                            </div>
                        </div>
                        <br>
                        <div  id="div-errors" class="pt-1">



                        </div>
                        <hr>
                        <div class="form-group row">
                        @csrf
                            <!--
                            <div class="col-lg-6 col-md-6">
                                <label>Location of BRT</label>
                                <select class="form-control" >
                                    <option>Gold</option>
                                    <option>Silver</option>
                                    <option>Bronze</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Vehicle Speed</label>
                                <select class="form-control" >
                                    <option>Gold</option>
                                    <option>Silver</option>
                                    <option>Bronze</option>
                                </select>
                            </div>
                            -->
                            <div class="col-lg-6 col-md-6">
                                <label>Departure Terminal</label>
                                <select name="departure_terminal" class="form-control" >
                                    <option value="" selected>Select Departure Terminal</option>
                                    @foreach($brtroutes as $id => $brtroute )
                                        <option value="{{ $id }}" >{{ $brtroute }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Destination Terminal</label>
                                <select name="destination_terminal" class="form-control" >
                                    <option value="" selected>Select Destination Terminal</option>
                                    @foreach($brtroutes as $id => $brtroute )
                                        <option value="{{ $id }}" >{{ $brtroute }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer mb-5">
                <button class="btn btn-success float-right etabtn"><i class="fa fa-check"></i>Get Duration</button>

            </div>
            </form>
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




