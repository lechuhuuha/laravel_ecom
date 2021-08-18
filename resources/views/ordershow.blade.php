@component('layouts.layout')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Order details </li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="description">ID</td>
                            <td class="description">Image</td>
                            <td class="description">Product name</td>
                            <td class="price">Price</td>
                            <td class="description">Order id</td>
                            <td class="description">Created at</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @guest
                            Sorry you have to login in order to use this order monitor
                        @else
                            @foreach ($order as $item)
                                <tr>
                                    <td class="cart_description">
                                        {{ $item->id }}
                                    </td>
                                    <td class="cart_product">
                                        @if ($item->product->images->first())
                                            <a href="{{ route('product.show', $item->product->id) }}"><img
                                                    src="{{ Storage::disk('local')->url($item->product->images->first()->path) }}"
                                                    width="100" height="100" alt="" /></a>
                                        @endif
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->product_price }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->order_id }}
                                    </td>
                                    <td class="cart_description">
                                        {{ $item->created_at->diffForHumans() }}
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
