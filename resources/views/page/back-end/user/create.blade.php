@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>
            @include ('component.flash-message')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Create User</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" class="form-control" type="text" name="first_name" placeholder=""/>
                                <label for="last_name">Last Name</label>
                                <input id="last_name" class="form-control" type="text" name="last_name" placeholder=""/>
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" class="form-control" type="text" name="phone_number" placeholder=""/>
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="text" name="password" placeholder=""/>
                                <label for="email">Email</label>
                                <input id="email" class="form-control" type="text" name="email" placeholder=""/>
                            </div>
                            <label>
                                Role ID
                                <select name="role_id" id="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </label>
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
