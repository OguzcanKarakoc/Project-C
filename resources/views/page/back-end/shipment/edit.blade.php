@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>
@include ('component.flash-message')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Edit Shipment</h1>
                    </div>
                </div>
            </div>


            <form action="{{ route('shipments.update', $shipment->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="Wordpress"
                                       value="{{ $shipment->name }}"/>
                                <label for="price">Price</label>
                                <input id="price" class="form-control" type="number" name="price" step="0.01"
                                       value="{{ $shipment->price }}"/>
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