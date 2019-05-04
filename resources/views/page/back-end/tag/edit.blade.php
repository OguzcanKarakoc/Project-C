@extends('layout.adminLayout.admin_design')

@section("content")
    <div id="content">
        <section>
            @include ('component.flash-message')
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="separator-left">Edit Tag</h1>
                    </div>
                </div>
            </div>


            <form action="{{ route('tags.update', $tag->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder=""
                                       value="{{ $tag->name }}"/>
                            </div>
                        </div>
                        <div class="col-12 cell">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>

@endsection
