@extends('admin_layouts.layout')
@section('contents')

    <div class="container-fluid">
        <div class="row">


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>
                <h2>Quan ly comment</h2>
                <div class="table-responsive">
                    <div class="row mt-5">
                        <div class="col-6"></div>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Order </th>
                                <th scope="col">User name</th>
                                <th scope="col">Product price</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $item)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->user ? $item->user->name : 'guest' }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.orders.edit', $item->id) }}">Update</a>

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
                                                        <form action="{{ route('admin.orders.delete', $item->id) }}"
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
                    {{-- {{ $orders->links() }} --}}

                </div>
            </main>
        </div>
    </div>
    >
@endsection
