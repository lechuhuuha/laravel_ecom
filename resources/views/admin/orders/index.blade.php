@extends('admin_layouts.layout')
@section('contents')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <h1>Quan ly order</h1>
                <div class="table-responsive">
                    <div class="row mt-5">
                        <div class="col-6"></div>
                    </div>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Delevery date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td> <a href="{{ route('admin.orders.show', $item->id) }}"> {{ $item->id }}</a>
                                    </td>
                                    {{-- <td>{{ $item->image }}</td> --}}
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <form action="" id="order-form-{{ $item->id }}" method="post">
                                            @csrf
                                            <select class="form-select" id="order-status-{{ $item->id }}" name="status">
                                                @foreach (config('common.order.status') as $key => $value)

                                                    @if ($value == $item->status)
                                                        <option selected value="{{ $value }}">
                                                            {{ $key }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $value }}">
                                                            {{ $key }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </form>

                                    </td>
                                    <td>{{ $item->del_date }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
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

    <script>
        var orderArray = [
            @foreach ($orders as $item)
                "{{ $item->id }}",
            @endforeach
        ];
        orderArray.forEach(element => {
            var statusForm = document.getElementById("order-form-" + element);
            var orderStatus = document.getElementById('order-status-' + element);
            var _token = document.getElementsByName('_token');
            var url = '/admin/products/order/changeStatus/' + element;
            orderStatus.addEventListener('change', async function() {
                console.log(orderStatus.value);
                var token = _token[0].value;
                await fetch(url, {
                        method: "POST",
                        body: JSON.stringify({
                            id: element,
                            status: orderStatus.value
                        }),
                        headers: {
                            "X-CSRF-TOKEN": token,
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        }
                    }).then(result => {
                        return (result.json());
                    }).then(function(json) {
                        console.log(json);
                        if (json['responseCode'] == 200 && json["message"].length < 2) {
                            orderStatus.selectedIndex = parseInt(json["message"]) - 1;
                        } else if (json["message"] == 'delivered') {
                            location.reload();
                            console.log('delivered');
                        } else if (json["message"] == 'deleted') {
                            console.log('deleted')
                            location.reload();
                        } else {
                            orderStatus.selectedIndex = parseInt(json["message"]) - 1;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    })
            })

        });
    </script>

@endsection
