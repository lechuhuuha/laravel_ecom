@props(['products'])
<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($products as $item)
                            @if ($item->images->count() > 0)
                                @if ($loop->iteration <= 3)
                                    <div class="item {{ $loop->iteration == 1 ? 'active' : '' }}">
                                        <div class="col-sm-6">
                                            <h1><span>E</span>-SHOPPER</h1>
                                            <h2>{{ $item->name }}</h2>
                                            <p>{{ \Illuminate\Support\Str::words($item->description, 10) }}</p>
                                            <button type="button" class="btn btn-default get"><a
                                                    href="{{ route('product.show', $item->id) }}">Get it
                                                    now</a></button>
                                        </div>
                                        <div class="col-sm-6">
                                            @if ($item->images->first())

                                                <img class="girl" height="300" width="500"
                                                    src="{{ Storage::disk('local')->url($item->images->first()->path) }}"
                                                    alt="" />
                                            @endif

                                        </div>
                                    </div>

                                @endif

                            @endif

                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->
