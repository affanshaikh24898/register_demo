@extends('users.layout')

@section('content')
<div class="container">
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>
        {{$error}}
      </li>
      @endforeach
      <button type="button" class="close" data-dismiss="alert">×</button>
    </ul>
    
   </div>
  @endif
  @if(session()->get('message'))
  <div class="alert alert-success" role="alert">
    <strong>Success: </strong>{{session()->get('message')}}
    <button type="button" class="close" data-dismiss="alert">×</button>
  </div>
  @endif
  <a class="btn btn-success" href="{{ route('users.index') }}"> back</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->username}}'s Profile</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($message = Session::get('success'))
                      <div class="alert alert-success">
                   <p>{{$message}}</p>
                      </div>
                   @endif
                    <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                       <div class="form-group">
                           <label for="username"><strong>username:</strong></label>
                           <input type="text" class="form-control" id ="username" name="username" value="{{ $user->username}}">
                       </div>
                       <div class="form-group">
                           <label for="fname"><strong>fname:</strong></label>
                           <input type="text" class="form-control" id ="fname" name="fname" value="{{ $user->fname}}">
                       </div>
                       <div class="form-group">
                           <label for="lname"><strong>Name:</strong></label>
                           <input type="text" class="form-control" id ="lname" name="lname" value="{{ $user->lname}}">
                       </div>
                       <div class="form-group">
                           <label for="email"><strong>email:</strong></label>
                           <input type="text" class="form-control" id ="email" name="email" value="{{ $user->email}}">
                       </div>
                       <div class="form-group">
                           <label for="date_of_birth"><strong>date_of_birth:</strong></label>
                           <input type="date" class="form-control" id ="date_of_birth" name="date_of_birth" value="{{ $user->date_of_birth}}"  max="<?php echo date("Y-m-d"); ?>">
                       </div>
                       <div class="form-group">
                           <label for="image"><strong>image:</strong></label>
                           <input type="file" class="form-control" id ="image" name="image">
                       </div>
                       <div class="form-group">
                           <label for="gender"><strong>gender:</strong></label>
                           <select class="form-control" id="gender" name="gender">
                            <option value="" selected disabled><b>select gender</b></option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                       </div>
                       
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection