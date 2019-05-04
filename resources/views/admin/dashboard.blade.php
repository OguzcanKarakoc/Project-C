@extends('layout.adminLayout.admin_design')
@section('content')
  <div id="content">
    <div class="container mt-5">
      <div class="row">
        <div class="col-6">
          <select class="form-control" name="line-chart-date" id="line-chart-date">
            <option value="months" selected>Months</option>
            <option value="days">Days current month</option>
            <option value="years">Years</option>
          </select>
          <canvas id="line-chart-sold" width="800" height="450"></canvas>
        </div>
        <div class="col-6">
          <select class="form-control" name="line-profitchart-date" id="line-profitchart-date">
            <option value="months" selected>Months</option>
            <option value="days">Days current month</option>
            <option value="years">Years</option>
          </select>
          <canvas id="line-chart-profit" width="800" height="450"></canvas>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col-12">
          <h2>Almost out of stock: </h2>
          <div class="row" id="ajax_container">
            @include('admin.paginate')
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
