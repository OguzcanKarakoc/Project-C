@extends('layout.adminLayout.admin_design')

@section("content")

    <section>
        @include('component.flash-message')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="separator-left">Order Status</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('orderStatuses.create') }}"
                       class="btn btn-primary"><span>New Order Status </span></a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderStatuses as $orderStatus)
                            <tr>
                                <td>{{ $orderStatus->id }}</td>
                                <td>{{ $orderStatus->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('orderStatuses.edit', $orderStatus->id )  }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('orderStatuses.destroy', $orderStatus->id) }}" method="post">
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
                    {!! $orderStatuses->render() !!}
                </div>
            </div>
        </div>
    </section>

@endsection