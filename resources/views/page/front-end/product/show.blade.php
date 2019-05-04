@extends('layout.app')

@section('scripts')
    @if (Session::has('message1'))
        <script type="application/javascript">
            swal({
                icon: 'error',
                text: "<?= Session::get('message1') ?>",
            });
        </script>
    @endif
    @if (Session::has('message2'))
        <script type="application/javascript">
            swal({
                icon: 'success',
                text: "<?= Session::get('message2') ?>",
            });
        </script>
    @endif
    @if (Session::has('message3'))
        <script type="application/javascript">
            swal({
                icon: 'info',
                text: "<?= Session::get('message3') ?>",
            });
        </script>
    @endif
    @if (Session::has('message5'))
        <script type="application/javascript">
            swal({
                icon: 'info',
                text: "<?= Session::get('message5') ?>",
            });
        </script>
    @endif
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Image -->
            <div class="col-12 col-lg-6">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <div class="row">
                            @foreach($product->productImages as $image)
                                <div class="col-6">
                                    <img src="{{ url($image->url) }}" alt="" class="img-thumbnail" style="height: 140px">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add to cart -->
            <div class="col-12 col-lg-6 add_to_cart_block">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <p class="price">€ {{ $product->price }}</p>
                        <h1 class="card-title">{{ $product->title }}</h1>
                        <p>Status: {{ $product->productStatus->name }}</p>
                        <p>Categories:
                            @foreach($product->categories as $category)
                                @if($loop->last)
                                    {{ $category->name }}
                                @else
                                    {{ $category->name }},
                                @endif
                            @endforeach
                        </p>

                        <div>Average rating: <span class="avg-rating">{{ $avgRating }}</span>
                            @if($avgRating >= 2.5)
                                <i class="fas fa-thumbs-up" style="color: green;"></i> @elseif ($avgRating != null)
                                <i class="fas fa-thumbs-down" style="color: red;"></i> @endif</div>

                        @if($product->productStatus->name != "Out of stock")
                            <div class="form-group" style="padding-top: 15px;">
                                <label>Quantity :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                                data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control quantity" id="quantity" name="quantity"
                                           min="1"
                                           max="100" value="{{1}}">
                                    <div class="input-group-append">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                                data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-lg btn-block text-uppercase update-cart-btn"
                                    data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                        @endif

                        {{--Add to favorites--}}
                        <form action="{{url('/addToFavorites')}}" method="post" style="margin-top: 10px">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product_id"/>

                            <button type="submit" value="on"
                                    class="btn btn-success btn-lg btn-block text-uppercase">
                                <i class="fa fa-heart"></i> Add to Favorites
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i
                            class="fa fa-align-justify"></i>
                        Description
                    </div>
                    <div class="card-body">
                        {{ $product->description }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i
                            class="fa fa-align-justify"></i>
                        Rating
                    </div>
                    <div class="container">
                        <form id="rating-form" >
                            @csrf
                            <div class="form-group">
                                @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="card-body text-center">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            @for($i = 1; $i <= 5 ; $i++ )
                                                @if(!is_null($rating))
                                                    @if($rating->rating == $i)
                                                        <label class="btn btn-secondary active">
                                                            <input type="radio" data-product-id="{{ $product->id }}" name="rating"
                                                                   id="rating{{ $i }}" autocomplete="off" value="{{ $i }}"
                                                                   checked>{{ $i }}
                                                        </label>
                                                    @else
                                                        <label class="btn btn-secondary">
                                                            <input type="radio" data-product-id="{{ $product->id }}" name="rating"
                                                                   id="rating{{ $i }}" autocomplete="off"
                                                                   value="{{ $i }}">{{ $i }}
                                                        </label>
                                                    @endif
                                                @else
                                                    <label class="btn btn-secondary">
                                                        <input type="radio" data-product-id="{{ $product->id }}" name="rating"
                                                               id="rating{{ $i }}" autocomplete="off" value="{{ $i }}">{{ $i }}
                                                    </label>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment"> Comment: </label>
                                        <textarea name="comment" class="form-control" id="comment" cols="30"
                                                  rows="10">@if(!is_null($rating)) {{ $rating->comment }} @endif</textarea>
                                    </div>

                                    <div class="form-group" id="pros">
                                        <div id="add-pros" class="btn btn-outline-secondary mb-3">Add pro <i
                                                class="fas fa-plus-circle"
                                                style="color:green;"></i></div>
                                        @if (isset($rating->prosCons))
                                            @foreach($rating->prosCons as $prosCon)
                                                @if($prosCon->vote)
                                                    <div class="row mb-3" id="pros-cons-{{ $prosCon->id }}">
                                                        <div class="col-10">
                                                            <input type='text' name='updatePros[{{ $prosCon->id }}]'
                                                                   placeholder='PRO'
                                                                   class='form-control' value="{{ $prosCon->text }}"/>
                                                        </div>
                                                        <div class="col-2">
                                                            <a class="delete-pros-cons btn btn-danger"
                                                               data-pros-cons-id="{{ $prosCon->id }}"><i
                                                                    class="fas fa-trash-alt" style="color: #ffffff"></i></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group" id="cons">
                                        <div id="add-cons" class="btn btn-outline-secondary mb-3">Add con <i
                                                class="fas fa-minus-circle"
                                                style="color: darkred"></i></div>
                                        @if (isset($rating->prosCons))
                                            @foreach($rating->prosCons as $prosCon)
                                                @if(!$prosCon->vote)
                                                    <div class="row mb-3" id="pros-cons-{{ $prosCon->id }}">
                                                        <div class="col-10">
                                                            <input type='text' name='updatePros[{{ $prosCon->id }}]'
                                                                   placeholder='CON'
                                                                   class='form-control' value="{{ $prosCon->text }}"/>
                                                        </div>
                                                        <div class="col-2">
                                                            <a class="delete-pros-cons btn btn-danger"
                                                               data-pros-cons-id="{{ $prosCon->id }}"><i
                                                                    class="fas fa-trash-alt" style="color: #ffffff;"></i></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" id="rating-submit" type="submit">Submit</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                        <hr>
                        @foreach($ratings as $rating)
                            <div class="row">
                                <div class="col-3">
                                    {{ $rating->user->first_name }} {{ $rating->user->last_name }}
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-8">
                                            Rating: {{ $rating->rating }}
                                            @if($rating->rating >= 2.5)
                                                <i class="fas fa-thumbs-up" style="color: green; padding-left: 3px;"></i> @else
                                                <i class="fas fa-thumbs-down" style="color: red; padding-left: 3px;"></i> @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            {{ $rating->comment }}
                                        </div>
                                        <hr/>
                                        <div class="col-6">
                                            @foreach($rating->prosCons as $prosCon)
                                                @if($prosCon->vote)
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <i class="fas fa-plus-circle" style="color: green"></i>
                                                        </div>
                                                        <div class="col-10">
                                                            {{ $prosCon->text }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-6">
                                            @foreach($rating->prosCons as $prosCon)
                                                @if(!$prosCon->vote)
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <i class="fas fa-minus-circle" style="color: darkred"></i>
                                                        </div>
                                                        <div class="col-10">
                                                            {{ $prosCon->text }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Reviews -->
            <div class="col-12" id="reviews">
                <div class="card border-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i
                            class="fa fa-comment"></i>
                        Specification
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Categories</th>
                                <th scope="col" style="color: white">Categories</th>
                            </tr>
                            </thead>
                            {{--<tbody>--}}
                            {{--@foreach($product->specifications as $specification)--}}
                            {{--<tr>--}}
                            {{--<th>{{ $specification->key }}</th>--}}
                            {{--<td>{{ $specification->value }}</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                            <tbody>
                            @foreach($product->categories as $category)
                                <tr>
                                    @if($loop->first)
                                        <th style="font-weight: normal;">{{ $product->title }}</th>
                                        <th style="font-weight: normal;">{{ $category->name }}</th>
                                        <th style="font-weight: normal; color: white">{{ $product->title }}</th>
                                    @else
                                        <th style="font-weight: normal; color: white">{{ $product->title }}</th>
                                        <th style="font-weight: normal;">{{ $category->name }}</th>
                                        <th style="font-weight: normal; color: white">{{ $product->title }}</th>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
