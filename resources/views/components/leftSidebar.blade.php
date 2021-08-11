@props(['categories', 'brands'])
<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        @foreach ($categories as $item)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{ route('product.category.show', $item->name) }}">
                            {{ $item->name }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach


    </div>
    <!--/category-products-->

    <div class="brands_products">
        <!--brands_products-->
        <h2>Brands</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach ($brands as $item)
                    <li><a href="{{ route('product.brand.show', $item->name) }}"> <span
                                class="pull-right">{{ $item->products->count() }}</span>{{ $item->name }}</a>
                    </li>

                @endforeach
            </ul>
        </div>
    </div>
    <!--/brands_products-->

    <div class="price-range">
        <!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            {{-- <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b> --}}
            <form action="" method="get">
                <label for="">Min price</label>
                <input type="number" name="price[]" id="">
                <label for="">Max price</label>
                <input type="number" name="price[]" id="">

                <button class="btn btn-default get">Submit</button>
            </form>

        </div>
    </div>
    <!--/price-range-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
    </div>
    <!--/shipping-->

</div>