@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Action on this permissions of USER {{ $user->name }}</h1>

        <form method="POST" action="{{ route('admin.permissions.saveAction', [$user->id, $permissionsId]) }}">
            @csrf
            <div class="mb-3 mt-3 ">
                <label for="">Permissions</label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach (config('permissions.action') as $key => $value)
                        <input type="checkbox" {{ $permissions & $value ? 'checked' : '' }} name="permissions[]"
                            id="btn{{ $key }}" value="{{ $value }}" class="btn-check">
                        <label for="btn{{ $key }}" class="btn btn-outline-primary">{{ $key }}</label>
                    @endforeach

                </div>

            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
