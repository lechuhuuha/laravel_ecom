@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Edut brands {{ $item->name }}</h1>

        <form method="POST" action="{{ route('admin.brands.update', $item->id) }}">
            @csrf

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="name" name="name" value="{{ $item->name }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('name')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
