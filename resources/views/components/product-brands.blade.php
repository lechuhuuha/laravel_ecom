@props(['productBrandRelated'])
@foreach ($productBrandRelated as $productBrand)
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    @if ($productBrand->images->count() > 0)
                        {{-- {{ dump($productBrand->images->first()->path) }} --}}
                        <img src="{{ Storage::disk('local')->url($productBrand->images->first()->path) }}" width="100"
                            height="250" alt="image" />
                    @endif
                    <h2>{{ $productBrand->price }}</h2>
                    <p><a href="{{ route('product.show', $productBrand->id) }}">
                            {{ $productBrand->name }}</a>
                    </p>
                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i><a
                            href="{{ route('addToCart', $productBrand->id) }}">Add to
                            cart</a></button>
                </div>
            </div>
        </div>
    </div>

@endforeach
