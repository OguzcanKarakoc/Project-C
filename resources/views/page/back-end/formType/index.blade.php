@extends('layout.adminLayout.admin_design')

@section("content")

    <section>
        @include('component.flash-message')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="separator-left">Form Type</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('formTypes.create') }}"
                       class="btn btn-primary"><span>New Form Type</span></a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($formTypes as $formType)
                            <tr>
                                <td>{{ $formType->id }}</td>
                                <td>{{ $formType->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('formTypes.edit', $formType->id )  }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('formTypes.destroy', $formType->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $formTypes->render() !!}
                </div>
            </div>
        </div>
    </section>

@endsection