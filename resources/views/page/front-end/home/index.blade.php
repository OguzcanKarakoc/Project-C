@extends('layout.app')

@section('content')
    <div class="container">
        <header class="jumbotron hero-spacer" style="background-image: url({{ $highlight->productImages->first()->url }});background-size: cover; background-repeat: no-repeat">
            <h1 style="font-weight:900; text-shadow: 0 0 0.5px #000, -1px -1px #000, 1px 1px #000;
        font-size: xx-large; color: white">{{ $highlight->title }}</h1>
            <p style="font-weight:900; text-shadow: 0 0 0.5px #000, -1px -1px #000, 1px 1px #000;
        font-size: x-large; color: white">
                @foreach($highlight->categories as $category)
                    {{ $category->name }}
                @endforeach
            </p>
            <a href="{{ route('products.show', $highlight->id) }}" class="btn btn-primary btn-large">Click here</a>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <h3>Top Products</h3>
            </div>
        </div>
    </div>

    <hr/>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="text-center">
            <div class="carousel-inner" role="listbox">
                @for($i = 0; $i < $popular_products->count(); $i = $i + 3)
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <div class="row">
                            @for($x = $i; $x < $i + 3; $x++)
                                <div class="col-4">
                                    <div class="product-grid3">
                                        <div class="product-image3">
                                            <a href="{{ route('products.show', $popular_products->get($x)->id) }}">
                                                @if($popular_products->get($x)->productImages->take(2)->get(0) !== null)
                                                    <img class="pic-1" src="{{ $popular_products->get($x)->productImages->take(2)->get(0)->url }}">
                                                @endif
                                                @if($popular_products->get($x)->productImages->take(2)->get(1) !== null)
                                                    <img class="pic-2" src="{{ $popular_products->get($x)->productImages->take(2)->get(1)->url }}">
                                                @endif
                                            </a>
                                            <ul class="social">
                                                <li><a href="{{ route('products.show', $popular_products->get($x)->id) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                                @if($popular_products->get($x)->productStatus->name != "Out of stock")
                                                    <li><a class="add-cart" data-product-id="{{ $popular_products->get($x)->id }}"><i class="fa fa-shopping-cart"></i></a></li>

                                                @endif
                                            </ul>
                                            @if($popular_products->get($x)->productStatus->name == "Out of stock")
                                                <span class="product-new-label">{{ $popular_products->get($x)->productStatus->name }}</span>
                                            @endif

                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="{{ route('products.show', $popular_products->get($x)->id) }}">{{ $popular_products->get($x)->title }}</a>
                                            </h3>
                                            <div class="price">
                                                €{{ $popular_products->get($x)->price }}
                                                {{-- TODO:: SALE <span>€{{ $product->price }}</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
           data-slide="prev" style="width: 25px">
            <i class="fas fa-arrow-circle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
           data-slide="next" style="width: 25px">
            <i class="fas fa-arrow-circle-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br/>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h3>Recent Products</h3>
        </div>
    </div>
    <hr/>
    <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
        <div class="text-center">
            <div class="carousel-inner" role="listbox">
                @for($i = 0; $i < $recent_products->count(); $i = $i + 3)
                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <div class="row">
                            @for($x = $i; $x < $i + 3; $x++)
                                <div class="col-4">
                                    <div class="product-grid3">
                                        <div class="product-image3">
                                            <a href="{{ route('products.show', $recent_products->get($x)->id) }}">
                                                @if($recent_products->get($x)->productImages->take(2)->get(0) !== null)
                                                    <img class="pic-1"
                                                         src="{{ $recent_products->get($x)->productImages->take(2)->get(0)->url }}">
                                                @endif
                                                @if($recent_products->get($x)->productImages->take(2)->get(1) !== null)
                                                    <img class="pic-2"
                                                         src="{{ $recent_products->get($x)->productImages->take(2)->get(1)->url }}">
                                                @endif
                                            </a>
                                            <ul class="social">
                                                <li><a href="{{ route('products.show', $recent_products->get($x)->id) }}"><i
                                                            class="fa fa-shopping-bag"></i></a></li>
                                                @if($recent_products->get($x)->productStatus->name != "Out of stock")
                                                    <li><a class="add-cart"
                                                           data-product-id="{{ $recent_products->get($x)->id }}"><i
                                                                class="fa fa-shopping-cart"></i></a></li>
                                                @endif
                                            </ul>
                                            @if($recent_products->get($x)->productStatus->name == "Out of stock")
                                                <span
                                                    class="product-new-label">{{ $recent_products->get($x)->productStatus->name }}</span>
                                            @endif

                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a
                                                    href="{{ route('products.show', $recent_products->get($x)->id) }}">{{ $recent_products->get($x)->title }}</a>
                                            </h3>
                                            <div class="price">
                                                €{{ $recent_products->get($x)->price }}
                                                {{-- TODO:: SALE <span>€{{ $product->price }}</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls2" role="button"
           data-slide="prev" style="width: 25px">
            <i class="fas fa-arrow-circle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls2" role="button"
           data-slide="next" style="width: 25px">
            <i class="fas fa-arrow-circle-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br>
    <br>
    </div>

@endsection