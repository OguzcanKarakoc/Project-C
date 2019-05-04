@extends('layout.adminLayout.admin_design')

@section("content")

    <section>
        @include('component.flash-message')

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="separator-left">Shipment</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('shipments.create') }}"
                       class="btn btn-primary"><span>New Shipment </span></a>
                    <div class="row" id="ajax_container">
                        @include('page.back-end.shipment.paginate')
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection