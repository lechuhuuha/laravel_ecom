@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>New permissions</h1>

        <form method="POST" action="{{ route('admin.permissions.storeAddUser') }}">
            @csrf
            <div class="mb-3 mt-3">

                <label for="exampleInputEmail1" class="form-label">User</label>
                <select name="permissionsArr[user_id]" id="">
                    <option value="" selected disabled hidden>Choose here</option>

                    @foreach ($users as $item)
                        @if (old('permissionsArr'))
                            @if ($item->id == dump(old('permissionsArr')['user_id']))
                                <option selected value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endif
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
                        @endif

                    @endforeach
                </select>

            </div>
            <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label">Permissions</label>
                <select name="permissionsArr[permission_id]" id="">
                    <option value="" selected disabled hidden>Choose here</option>
                    @foreach ($permissions as $item)
                        @if (old('permissionsArr'))
                            @if ($item->id == dump(old('permissionsArr')['permission_id']))
                                <option selected value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}
                                </option>
                            @endif
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}
                            </option>
                        @endif
                    @endforeach
                </select>

            </div>
            @error('permissionsArr')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3 mt-3 ">
                <label for="">Permissions</label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach (config('permissions.action') as $key => $value)

                        <input type="checkbox" name="permissions[]" id="btn{{ $key }}"
                            value="{{ $value }}" class="btn-check">
                        <label for="btn{{ $key }}" class="btn btn-outline-primary">{{ $key }}</label>
                    @endforeach

                </div>

            </div>
            @error('permissions')
                <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
