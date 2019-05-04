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


            <form action="{{ route('formTypes.update', $formType->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                Name
                                <input type="text" name="name" placeholder="Wordpress" value="{{ $formType->name }}"/>
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