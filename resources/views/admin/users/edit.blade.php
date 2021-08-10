@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Edit user</h1>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" >
            @csrf

            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="name" name="name" value="{{ $user->name }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('name')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">

            </div>
            @error('email')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3 ">
                <label for="">Role</label>
                <select name="role" id="">
                    <option {{ $user->role == 1 ? 'selected' : '' }} value="1">Admin</option>
                    <option {{ $user->role == 0 ? 'selected' : '' }} value="0">User</option>
                </select>
            </div>
            @error('role')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
