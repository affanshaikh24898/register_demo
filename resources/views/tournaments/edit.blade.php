@extends('tournaments.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit tournament</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tournaments.index') }}"> Back</a>
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

    <form action="{{ route('tournaments.update',$tournament->id) }}" method="POST"  name="myform1" id="myform1" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $tournament->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>team_size:</strong>
                    {{-- <input type="text" name="team_size" class="form-control" placeholder="team_size"> --}}
                    <select class="form-control" id="team_size" name="team_size">
                        <option value="" selected disabled><b>select team_size</b></option>
                        <option value="4">4</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary"  onclick="return showLoading();">Submit</button>
            </div>
        </div>

    </form>
    <script>

        $(document).ready(function () {

        $('#myform1').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                team_size: {
                    required: true
                },

            }
        });
    });
    </script>
@endsection
