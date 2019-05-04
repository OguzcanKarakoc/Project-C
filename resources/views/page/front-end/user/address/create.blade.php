@extends('layout.app')

@section("content")
    <div id="content">
        <div class="container profile">
        <section>

            @include('component.flash-message')

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Address</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('addresses.store',  \Illuminate\Support\Facades\Auth::id()) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>
                                    Street
                                    <input type="text" name="street" placeholder="" class="form-control"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    House Number
                                    <input type="text" name="house_number" placeholder="" class="form-control"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    Postcode
                                    <input type="text" name="postcode" placeholder="" class="form-control"/>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>
                                    City
                                    <input type="text" name="city" placeholder="" class="form-control"/>
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