@component('layouts.layout')

    <section style="margin: 10px;padding: 10px;" id="cart_items">
        <div class="container">
            <div class="shopper-informations">
                <div class="row">
                    <div class="checkout-options">
                        @guest
                            <h3>New User</h3>
                            <p>Checkout options</p>
                            <ul class="nav">
                                <li>
                                    <label><a href="/register">Register Account</a> </label>
                                </li>
                                <li>
                                    <label>Or default is Guest Checkout</label>
                            </ul>
                            </li>
                        @else
                            <h3>
                                Welcome <strong>{{ Auth::user()->name }}</strong> this is your checkout order :
                            </h3>
                        @endguest
                    </div>
                    <!--/checkout-options-->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="shopper-info">
                            <p>Shopper Information</p>
                            <form action="{{ route('createOrder') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="shopper-info">
                                        <div class="col-sm-6">
                                            @guest
                                                <input class="form-control" type="text" name="email" placeholder="Email*">
                                                <input class="form-control" type="text" name="first_name"
                                                    placeholder="First Name *">
                                                <input class="form-control" type="text" name="last_name"
                                                    placeholder="Last Name *">
                                            @else
                                                Note : User don't have to fill out this form
                                            @endguest

                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="address"
                                                placeholder="Address 1 *">
                                            <input class="form-control" type="text" name="zip"
                                                placeholder="Zip / Postal Code *">
                                            <input class="form-control" type="text" name="phone" placeholder="Phone *">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-default check_out">Proceed to Payment</button>

                            </form>

                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
@endcomponent
