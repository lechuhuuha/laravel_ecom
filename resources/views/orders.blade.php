@component('layouts.layout')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="description">ID</td>
                            <td class="description">Status</td>
                            <td class="price">Price</td>
                            <td class="description">Username</td>
                            <td class="description">Email</td>
                            <td class="description">Phone</td>
                            <td class="description">Address</td>
                            <td class="description">Zip</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @guest
                            Sorry you have to login in order to use this order monitor
                        @else
                            @foreach ($order_details as $item)
                                <tr>
                                    <td class="cart_description">
                                        <a href="{{ route('order.show', ['id' => $item->order->id]) }}">
                                            {{ $item->order->id }}
                                        </a>
                                    </td>
                                    <td class="cart_description">
                                        @foreach (config('common.order.status') as $key => $value)
                                            @if ($value == $item->order->status)
                                                <p>{{ $key }}</p>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ $item->order->price }}</p>
                                    </td>
                                    <td class="cart_description">
                                        {{ $users->name }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $users->email }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->order->phone }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->order->address }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->order->zip }}
                                    </td>
                                </tr>
                            @endforeach

                        @endguest

                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endcomponent
