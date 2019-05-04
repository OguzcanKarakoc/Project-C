@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                @include('component.filter')
            </div>

            <div class="col-9">
                <h1>@yield('productListTitle', 'Products')</h1>
                <div id="ajax_container">
                    @include('page.front-end.product.paginate')
                </div>
            </div>
        </div>
    </div>
@endsection