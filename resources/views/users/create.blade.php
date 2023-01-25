@extends('users.layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">creat new user</div>
                  <div class="card-body">
  
                      <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group row">
                              <label for="username" class="col-md-4 col-form-label text-md-right">username</label>
                              <div class="col-md-6">
                                  <input type="text" id="username" class="form-control" name="username" required autofocus>
                                  @if ($errors->has('username'))
                                      <span class="text-danger">{{ $errors->first('username') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="fname" class="col-md-4 col-form-label text-md-right">fname</label>
                              <div class="col-md-6">
                                  <input type="text" id="fname" class="form-control" name="fname" required autofocus>
                                  @if ($errors->has('fname'))
                                      <span class="text-danger">{{ $errors->first('fname') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="lname" class="col-md-4 col-form-label text-md-right">lname</label>
                              <div class="col-md-6">
                                  <input type="text" id="lname" class="form-control" name="lname" required autofocus>
                                  @if ($errors->has('lname'))
                                      <span class="text-danger">{{ $errors->first('lname') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">date_of_birth</label>
                              <div class="col-md-6">
                                  <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" max="<?php echo date("Y-m-d"); ?>" required autofocus>
                                  @if ($errors->has('date_of_birth'))
                                      <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">image</label>
                              <div class="col-md-6">
                                  <input type="file" name="image" class="form-control" placeholder="image" required autofocus>
                                  @if ($errors->has('image'))
                                      <span class="text-danger">{{ $errors->first('image') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">gender</label>
                            <div class="col-md-6">
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" selected disabled><b>select gender</b></option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  submit
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection
