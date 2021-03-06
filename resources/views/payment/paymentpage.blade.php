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
                            <td class="price">Payment status</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="cart_price">
                                    <p>{{ $data['status'] }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <label for="">Shipping cost : Free</label>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">${{ $data['price'] }}</p>
                                </td>
                            </tr>

                    </tbody>
                </table>
            </div>
            <a class="btn btn-default check_out" href="">Pay now</a>

        </div>
    </section>

@endcomponent
