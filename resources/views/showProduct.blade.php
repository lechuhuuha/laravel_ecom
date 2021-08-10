@component('layouts.layout')
    <div class="col-sm-12 mx-auto my-auto padding-right" style="background-color: #ffffff !important">
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    @if ($product->images->count() > 0)

                        <img src="{{ Storage::disk('local')->url($product->images->first()->path) }}" width="200" alt="" />
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
                        <input type="text" value="3" />
                        <button type="button" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </span>
                    <p><b>Availability:</b>
                        @if ($product->count() > 0)
                            Con hang
                        @else
                            Het hang
                        @endif
                    </p>
                    <p><b>Brand:</b>
                        @foreach ($product->brands as $item)
                            {{ $item->name }}
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
                    <li><a href="#tag" data-toggle="tab">Tag</a></li>
                    <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
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
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery4.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                    @foreach ($product->comments as $item)
                        <div class="col-sm-12">
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>{{ $item->user->name }}</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i><time>
                                            {{ $item->user->created_at->format('F j, Y, g:i a') }}
                                        </time></a></li>
                            </ul>
                            <p>{{ $item->body }}</p>
                        </div>
                    @endforeach
                    @auth
                        <form action="{{ route('product.comment.store', $product->id) }}" method="POST">
                            @csrf
                            <h2>Want to participate</h2>


                            <h3>Hi {{ auth()->user()->name }} What do you want to discuss</h3>
                            <textarea placeholder="content" name="body"></textarea>
                            <button type="submit" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    @endauth

                </div>

            </div>
        </div>
        <!--/category-tab-->



    </div>
@endcomponent
