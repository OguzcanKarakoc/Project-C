<div class="row">
    @foreach($products as $product)
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="product-grid3">
                <div class="product-image3">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if($product->productImages->take(2)->get(0) instanceof \App\ProductImage)
                            <img class="pic-1" src="{{ $product->productImages->take(2)->get(0)->url }}">
                        @endif
                        @if($product->productImages->take(2)->get(1) instanceof \App\ProductImage)
                            <img class="pic-2" src="{{ $product->productImages->take(2)->get(1)->url }}">
                        @endif
                    </a>
                    <ul class="social">
                        <li><a href="{{ route('products.show', $product->id) }}">
                                <i class="fa fa-shopping-bag"></i>
                            </a></li>
                        @if($product->productStatus->name != "Out of stock")

                            <li>
                                <a class="add-cart" data-product-id="{{ $product->id }}">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>

                        @endif
                    </ul>
                    @if($product->productStatus->name == "Out of stock")
                        <span class="product-new-label">{{ $product->productStatus->name }}</span>
                    @endif

                </div>
                <div class="product-content">
                    <h3 class="title"><a
                            href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
                    </h3>
                    <div class="price">
                        €{{ $product->price }}
                        {{-- TODO:: SALE <span>€{{ $product->price }}</span> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{--    {{ $products->links() }}--}}
</div>

<div class="row">
    <div class="col-12">
        {{ $products->appends($_GET)->links() }}
    </div>
</div>