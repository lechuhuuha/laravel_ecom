@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Edit order</h1>

        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
            @csrf

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">First name</label>
                <input type="tect" name="first_name" value="{{ $order->first_name }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('first_name')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">address</label>
                <input type="text" name="address" value="{{ $order->address }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('address')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" name="email" value="{{ $order->email }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('email')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Last name</label>
                <input type="text" name="last_name" value="{{ $order->last_name }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('last_name')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $order->phone }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('phone')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Zip</label>
                <input type="text" name="zip" value="{{ $order->zip }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('zip')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
