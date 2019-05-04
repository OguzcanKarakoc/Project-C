@extends('layout.adminLayout.admin_design')

@section("content")
  <div id="content">
    <section>
      @include ('component.flash-message')
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="separator-left">Create Supplier</h1>
          </div>
        </div>
      </div>

      <form action="{{ route('suppliers.store') }}" method="post">
        @csrf
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="full_name">Full Name</label>
                <input id="full_name" class="form-control" type="text" name="full_name"
                       placeholder=""/>
                <label for="email">Email</label>
                <input id="email" class="form-control" type="text" name="email" placeholder=""/>
              </div>
            </div>
            <div class="col-12 cell">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </div>
      </form>

    </section>
  </div>

@endsection