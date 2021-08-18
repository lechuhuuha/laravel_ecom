@props(['products'])
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach ($products as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if ($item->images->count() > 0)
                            <img src="{{ Storage::disk('local')->url($item->images->first()->path) }}" width="100"
                                height="250" alt="" />
                        @endif


                        <h2>{{ $item->price }}</h2>
                        <p style="padding: 10px">{{ $item->name }}</p>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ $item->price }}</h2>
                            <p> <a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
                            </p>
                            <a href="{{ route('addToCart', ['id' => $item->id]) }}"
                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    @endforeach

</div>
{{ $products->links() }}

<!--features_items-->
