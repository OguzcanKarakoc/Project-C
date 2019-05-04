@extends('layout.app')

@section("content")
    <div id="content">
        <div class="container profile">
        <section>
            @include('component.flash-message')

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left"> Edit Address</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('addresses.update',[$user_id, $address->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>
                                    Street
                                    <input type="text" name="street" placeholder="Lorum Ipsum" class="form-control" value="{{ $address->street }}"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    House Number
                                    <input type="text" name="house_number" placeholder="lorum ipsum description" class="form-control" value="{{ $address->house_number }}"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    Postcode
                                    <input type="text" name="postcode" placeholder="Lorum Ipsum" class="form-control" value="{{ $address->postcode }}"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    City
                                    <input type="text" name="city" placeholder="Lorum Ipsum" class="form-control" value="{{ $address->city }}"/>
                                </label>
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
    </div>
    <style>
        .profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
    </style>

@endsection