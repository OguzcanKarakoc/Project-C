@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>
            @include ('component.flash-message')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Create Shipment</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('shipments.store') }}" method="post">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder=""/>
                                <label for="price">Price</label>
                                <input id="price" class="form-control" type="number" name="price" step="0.01"/>
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