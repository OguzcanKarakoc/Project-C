@extends('layout.app')

@section("content")
    <div class="container profile">
        <div id="content">
            <section>
                @include ('component.flash-message')
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="separator-left">Edit User</h1>
                        </div>
                    </div>
                </div>


                <form action="{{ route('front-user.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" class="form-control" type="text" name="first_name"
                                               placeholder=""
                                               value="{{$user->first_name}}"/>
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" class="form-control" type="text" name="last_name"
                                               placeholder=""
                                               value="{{$user->last_name}}"/>
                                        <label for="phone_number">Phone Number</label>
                                        <input id="phone_number" class="form-control" type="text" name="phone_number"
                                               placeholder=""
                                               value="{{$user->phone_number}}"/>
                                        <label for="password">New password (optional)</label>
                                        <input id="password" class="form-control" type="password" name="password" placeholder="" value=""/>
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="text" name="email" placeholder=""
                                               value="{{$user->email}}"/>
                                    </div>
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