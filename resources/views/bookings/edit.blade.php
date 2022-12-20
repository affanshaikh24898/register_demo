@extends('bookings.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bookings.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert">×</button>
            </ul>
        </div>
    @endif

    @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}
                <button type="button" class="close" data-dismiss="alert">×</button>
                </p>

            </div>
    @endif

    <form action="{{ route('bookings.update',$booking->id) }}" method="POST"  name="myform" id="myform" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>name:</strong>
                    <input type="text" name="name" value="{{ $booking->name }}" class="form-control" placeholder="name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>email:</strong>
                    <input type="text" name="email" value="{{ $booking->email }}" class="form-control" placeholder="email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>booking type:</strong>
                    <select class="form-control" id="booking_type" name="booking_type">
                        <option value="" selected disabled><b>select booking type</b></option>
                        <option value="full day">full day</option>
					    <option value="half day">half day</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>booking slot:</strong>
                    <select class="form-control" id="booking_slot" name="booking_slot">
                        <option value="" selected disabled><b>select booking slot</b></option>
                        <option value="morning">morning</option>
					    <option value="evening">evening</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>booking date:</strong>
                    <input type="date" name="booking_date" value="{{ $booking->booking_date }}" class="form-control" min="<?php echo date('Y-m-d'); ?>" placeholder="booking_date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>booking time:</strong>
                    <input type="time" name="booking_time" value="{{ $booking->booking_time }}" class="form-control" placeholder="booking_time">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary"  onclick="return showLoading();">Submit</button>
            </div>
        </div>

    </form>
    <script>

        $(document).ready(function () {

        $('#myform').validate({ // initialize the plugin
            rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            booking_type: {
                required: true
            },
            booking_slot: {
                required: true
            },
            booking_date: {
                required: true
            },
            booking_time: {
                required: true
            },

            }
        });
    });
    </script>
@endsection
