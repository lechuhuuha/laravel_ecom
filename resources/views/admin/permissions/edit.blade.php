@extends('admin_layouts.layout')
@section('contents')
    <div class="row ms-sm-auto col-lg-10 px-md-4">
        <h1>Edit permissions of {{ $user->name }}</h1>



        <div class="mb-3 mt-3 ">
            <label for="">Change Permissions you had : </label>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($user->permissions as $item)

                    <input type="checkbox" name="user_id[]" id="btn{{ $item->id }}" value="{{ $item->id }}"
                        class="btn-check">
                    <label for="btn{{ $item->id }}" class="btn btn-outline-primary">{{ $item->name }}</label>
                    <button data-toggle="modal" data-target="#exampleModal_{{ $item->id }}"
                        class="btn btn-danger">x</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal_{{ $item->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Xac nhan xoa ban ghi nay
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Huy</button>
                                    <form action="{{ route('admin.permissions.userdelete', [$user->id, $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Xoa</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>


        <form method="POST" action="{{ route('admin.permissions.update', $user->id) }}">
            @csrf

            <div class="mb-3 mt-3 ">
                <label for=""> Edit permissions you had : </label>
                <div class="list-group">
                    @foreach ($user->permissions as $item)

                        <a href="{{ route('admin.permissions.showAction', [$user->id, $item->id]) }}"
                            class="list-group-item list-group-item-action" aria-current="true">
                            {{ $item->name }}
                        </a>
                    @endforeach

                </div>



            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


@endsection
