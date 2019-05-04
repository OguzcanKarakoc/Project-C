@extends('layout.adminLayout.admin_design')

@section("content")

  <section>
    @include('component.flash-message')

    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="separator-left">Supplier</h1>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <a href="{{ route('suppliers.create') }}"
             class="btn btn-primary"><span>New Supplier </span></a>
          <div class="row" id="ajax_container">
            @include('page.back-end.supplier.paginate')
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection