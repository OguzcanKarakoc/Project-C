@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Create Form Type</h1>
                    </div>
                </div>
            </div>

            <form action="{{ route('formTypes.store') }}" method="post">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                Name
                                <input type="text" name="name" placeholder="Wordpress"/>
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
