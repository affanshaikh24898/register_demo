@extends('products.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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
    
    <form action="{{ route('products.update',$product->id) }}" method="POST"  name="myform" id="myform" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
     
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="description">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/image/{{ $product->image }}" width="300px">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>price:</strong>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>min_qty:</strong>
                    <input type="text" name="min_qty" value="{{ $product->min_qty }}" class="form-control" placeholder="min_qty">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>max_qty:</strong>
                    <input type="text" name="max_qty" value="{{ $product->max_qty }}" class="form-control" placeholder="max_qty">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>status:</strong>
                    <select class="form-control" id="status" name="status">
                        <option value="" selected disabled><b>select status</b></option>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
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
     
        $('#myform').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true,
                },
                Image: {
                    required: true,
                    extension: "jpeg|png|jpg|gif|svg"
                },
                price: {
                    required: true,
                    digits: true
                },
                min_qty: {
                required: true,
                min: 1,
                max: 10
                },
                max_qty: {
                    required: true,
                    min: 11,
                    max: 100
                },
                status: {
                    required: true
                },
                
            }
        });
    });
    </script>
@endsection