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
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->items as $item)
                            @php
                                // // if($item['data']['path'] !== null ){
                                //     echo '<pre>';
                                //     print_r($item['data']['images'][0]->path);
                                //     echo '</pre>';
                                // // }
                            @endphp
                            <tr>
                                <td class="cart_product">
                                    <a href="{{ route('product.show', $item['data']['id']) }}"><img
                                            src="{{ Storage::disk('local')->url($item['data']['images'][0]->path) }}"
                                            width="50" alt="" /></a>
                                </td>
                                <td class="cart_description">
                                    <h5><a href="">{{ $item['data']['name'] }}</a></h5>
                                    <p>Web ID: {{ $item['data']['id'] }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ $item['data']['price'] }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up"
                                            href="{{ route('incrToCart', ['id' => $item['data']['id']]) }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"
                                            value="{{ $item['quantity'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down"
                                            href="{{ route('decrToCart', ['id' => $item['data']['id']]) }}"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">${{ $item['totalSinglePrice'] }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ route('cart.delete', ['id' => $item['data']['id']]) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <a class="btn btn-default check_out" href="{{ route('checkoutProduct') }}">Check Out</a>

            </div>
        </div>
    </section>

@endcomponent

<!--/#cart_items-->

<!--/#do_action-->
