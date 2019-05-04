@extends('layout.adminLayout.admin_design')

@section("content")
  <div id="content">
    <section>

      @include('component.flash-message')

      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="separator-left">Category</h1>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('categories.create') }}"
               class="btn btn-primary"><span>New Category </span></a>
            <div class="row" id="ajax_container">
              @include('page.back-end.category.paginate')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection