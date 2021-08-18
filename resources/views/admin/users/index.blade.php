@extends('admin_layouts.layout')
@section('contents')
    <div class="container-fluid">
        <div class="row">


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <h2>Quan ly san pham</h2>
                <div class="table-responsive">
                    <div class="row mt-5">
                        <div class="col-6"></div>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                {{-- <th scope="col">Image</th> --}}
                                <th scope="col">Role</th>
                                <th scope="col">Active</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td> <a href="{{ route('admin.users.show', $item->id) }}">
                                            {{ $item->name }}</a></td>
                                    {{-- <td>{{ $item->image }}</td> --}}
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role == config('common.user.role.admin') ? 'Admin' : 'User' }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.status', $item->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="active" value="{{ $item->active }}">
                                            <button>{{ $item->active == config('common.user.status.active') ? 'Active' : 'Not active' }}</button>
                                        </form>

                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.users.edit', $item->id) }}">Update</a>

                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-target="#exampleModal_{{ $item->id }}"
                                            class="btn btn-danger">Delete</button>
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
                                                        <button type="button" class="btn btn-default"
                                                            data-bs-dismiss="modal">Huy</button>
                                                        <form action="{{ route('admin.users.delete', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Xoa</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                    {{ $users->links() }}

                </div>
            </main>
        </div>
    </div>
@endsection
