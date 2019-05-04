<html>
<head></head>

<style>
    .purchase header
    {
        padding: 0px 0px 0px 0px;
        margin-bottom: 0px;
        border-bottom: 1px solid #3989c6;
    }
    .purchase header img
    {
        max-width: 200px;
        margin-top: 0;
        margin-bottom: 0;
    }
    .purchase .company-details
    {
        text-align: right;
        margin-top: 0;
        margin-bottom: 0;
    }
    .purchase main
    {
        padding: 0px 0px;
        margin-bottom: 0px;
    }

    .purchase .purchase-info
    {
        text-align: right;
    }
    .purchase-info .info-code
    {
        font-weight: bold;
    }
    .purchase-info .info-code .info-date
    {
        margin-top: 0;
        margin-bottom: 0;
    }

    th
    {
        padding-top: 4px;
        padding-bottom: 5px;
        text-align: left;
        border-bottom: 0.5px solid #3989c6;

    }

    td
    {
        padding-top: 5px;

    }

    h1
    {
        font-size: 125%;
    }

</style>

<body>
<div class="row">
  <div class="col-md-12">
    <div class="purchase overflow-auto">
    <header>
        <div class="row">
            <div class="col-sm-3 col-xs-3">
                {{--<img src="#" class="img-responsive">--}}
            </div>
            <div class="col-sm-9 col-xs-9 company-details">
                <div style="padding-right: 10px;">GameShop</div>
                <div style="padding-right: 10px;">www.gameshop@example.com</div>
                <div style="padding-right: 10px;"> + 33 12 14 15 16</div>
            </div>
        </div>
    </header>
    <main>
      <div class="panel-body">
        <div class="table-responsive">
          {{--<table class="table col-6">--}}
            <div class="row">
                <div class="col-sm-3 col-xs-3 to-details">
                    <div class="ad-left" style="float: left">
                    <h1>Account Details:</h1>
                    <div class="to-name">{{ $first_name }} {{$last_name}}</div>
                    <div class="to-address">{{ $order->address->street }} {{ $order->address->house_number }}</div>
                    <div class="to-city">{{ $order->address->city }}, {{ $order->address->postcode }}</div>
                    </div>
                    <div class="ad-left" style="float: right; padding-right: 10px;">
                    <h1 class="info-code" >Order Details:</h1>
                    <div class="info-code">Order number: {{ rand(10000, 20000) }}</div>
                    <div class="info-date">{{ $date->format('d-m-Y') }}</div>
                    <div class="info-date">{{ $date->format('H:i:s') }}</div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 table-responsive">
                    <table class="table table-condensed" border="0" cellspacing="0" cellpadding="0" width="100%">
                        <h1 style="margin-bottom: -10px;">Purchase Details:</h1>
                        <thead>
                <tr>
                  <th class="text-left" style="border-top: 1px solid #94d3e1">Title</th>
                    <th class="text-center col-xs-7 col-sm-7" style="border-top: 1px solid #94d3e1">Price</th>
                    <th class="text-center col-xs-1 col-sm-1" style="border-top: 1px solid #94d3e1">Quantity</th>
                  <th class="text-center col-xs-3 col-sm-3" style="border-top: 1px solid #94d3e1">Amount</th>
                </tr>
              </thead>
            <tbody>
              @php($total = 0)
              @foreach($result as $item)
                <tr>
                  <td>{{ $item['product']->title }}</td>
                  <td class="text-center">€ {{ $item['product']->price }}</td>
                  <td class="text-center">{{ $item['quantity'] }}</td>
                  <td class="text-right">
                    € {{ $subtotal = $item['product']->price * $item['quantity'] }}</td>
                </tr>
                @php($total = $total + $subtotal)
              @endforeach

              <tr>
                  <td class="text-center" style="color: white">text</td>
                  <td class="text-center" style="color: white">text</td>
                  <td class="text-center" style="color: white">text</td>
                  <td class="text-center" style="color: white">text</td>
              </tr>

              <tr>
                  <td style="border-top: 1px solid #94d3e1"><strong>Shipment:</strong> {{ $order->shipment->name }}</td>
                  <td class="text-center" style="border-top: 1px solid #94d3e1"></td>
                  <td class="text-center" style="border-top: 1px solid #94d3e1"></td>
                  <td class="text-right" style="border-top: 1px solid #94d3e1; padding-bottom: 5px;">€ {{ $order->shipment->price }}</td>
              </tr>

              <br>
              {{--style="border-top: 1px solid #3989c6;"--}}
              <tr>
                <td class="no-line"></td>
                <td class="no-line"></td>
                <td class="no-line text-center"><strong>Total</strong></td>
                <td class="no-line text-center" style="border-top: 1px solid #94d3e1">€ {{ $total + $order->shipment->price }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    </main>
    </div>
  </div>
</div>
</body>
</html>