@extends('layout.adminLayout.admin_design')

@section("content")
  <div id="content">
    <section>

      @include('component.flash-message')

      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="separator-left">Product</h1>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('products.create') }}"
               class="btn btn-primary"><span>New Product </span></a>
            <div class="row" id="ajax_container">
              @include('page.back-end.product.paginate')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection