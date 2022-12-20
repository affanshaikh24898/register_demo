@extends('bookings.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 bookings Example</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bookings.create') }}"> Create New booking</a>
                <a class="btn btn-success" href="/dashboard"> home</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}
            <button type="button" class="close" data-dismiss="alert">×</button>
            </p>

        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>name</th>
            <th>email</th>
            <th>booking type</th>
            <th>booking slot</th>
            <th>booking date</th>
            <th>booking time</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $booking->name }}</td>
            <td>{{ $booking->email }}</td>
            <td>{{ $booking->booking_type }}</td>
            <td>{{ $booking->booking_slot }}</td>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->booking_time }}</td>
            <td>
                <form action="{{ route('bookings.destroy',$booking->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('bookings.show',$booking->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('bookings.edit',$booking->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $bookings->links() !!}

@endsection
