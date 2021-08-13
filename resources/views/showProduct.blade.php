@component('layouts.layout')
    <div class="col-sm-12 mx-auto my-auto padding-right" style="background-color: #ffffff !important">
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    @if ($product->images->count() > 0)

                        <img src="{{ Storage::disk('local')->url($product->images->first()->path) }}" width="200"
                            alt="" />
                    @endif
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @if ($product->images->count() > 0)
                            @foreach ($product->images as $item)
                                <div class="item {{ $product->images->first()->id == $item->id ? 'active' : '' }}">
                                    <a href=""> <img src="{{ Storage::disk('local')->url($item->path) }}" width="200"
                                            alt="" />
                                    </a>

                                </div>
                            @endforeach
                        @endif

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    <!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $product->name }}</h2>
                    <p>Web ID: {{ $product->id }}</p>
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
                        <span>{{ $product->price }}</span>
                        <label>Quantity:</label>
                        <form action="{{ route('addToCart', ['id' => $product->id]) }}" method="post">
                            @csrf
                            <input type="text" name="quantity" value="1" />
                            <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart

                            </button>
                        </form>

                    </span>
                    <p><b>Availability:</b>
                        @if ($product->count() > 0)
                            Con hang
                        @else
                            Het hang
                        @endif
                    </p>
                    <p><b>Categories:</b>
                        @foreach ($product->categories as $item)
                            <a href="{{ route('product.category.show', $item->name) }}">{{ $item->name }}</a>
                        @endforeach
                    </p>
                    <p><b>Brand:</b>
                        @foreach ($product->brands as $item)
                            <a href="{{ route('product.brand.show', $item->name) }}">{{ $item->name }}</a>
                        @endforeach
                    </p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->

        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                    <li><a href="#tag" data-toggle="tab">Brand</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews ({{ $product->comments->count() }})</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <div class="col-sm-12">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <h2>{{ $product->price }}</h2>
                                    <p>{{ $product->name }}</p>
                                    <p>{{ $product->description }}</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="tag">
                    <x-product-brands :productBrandRelated="$productBrandRelated"></x-product-brands>

                </div>
                <x-product-reviews :product="$product"></x-product-reviews>
            </div>
        </div>
        <!--/category-tab-->



    </div>
@endcomponent
