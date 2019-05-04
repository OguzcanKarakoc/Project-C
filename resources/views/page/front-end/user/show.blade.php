@extends('layout.app')

@section('content')
  @if (Session::has('message1'))
    <div class="alert alert-success" style="margin-top: 10px">{{ Session::get('message1') }}</div>
  @endif
  @if (Session::has('message2'))
    <div class="alert alert-danger" style="margin-top: 10px">{{ Session::get('message2') }}</div>
  @endif
  <div class="container profile">
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            <a href="{{ route('front.user.edit', $user->id )  }}" class="btn btn-info">Edit</a>

            {{--<a href="{{ route('front.user.edit', $user->id) }}" class="btn btn-primary">Edit</a>--}}
            {{--<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" class="w-100"/>--}}
          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <h5>
              {{ $user->first_name }} {{ $user->last_name }}
            </h5>
            <h6>
              joined at: {{ $user->created_at->format('d M Y') }}
            </h6>
          </div>
        </div>
        <div class="col-md-2">
          {{--<input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>--}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="profile-work">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" colspan="2" class="text-center">User details</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Phone number</th>
                  <td>{{ $user->phone_number }}</td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td>{{ $user->email }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-8">
          <ul class="nav nav-tabs mb-3 font-weight-bold" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                 aria-controls="home" aria-selected="true">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                 aria-controls="profile" aria-selected="false">Order History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                 aria-controls="address" aria-selected="false">Addresses</a>
            </li>
          </ul>
          <div class="tab-content profile-tab">
            <div class="tab-pane fade show active" id="home" role="tabpanel"
                 aria-labelledby="home-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>Name</label>
                </div>
                <div class="col-md-6">
                  <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Email</label>
                </div>
                <div class="col-md-6">
                  <p>{{ $user->email }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Phone</label>
                </div>
                <div class="col-md-6">
                  <p>{{ $user->phone_number }}</p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @foreach($user->orders as $order)
                <div class="row">
                  <div class="col-md-3">
                    <label>Order: {{ $order->id }} <br> Status: {{ $order->orderStatus->name }} <br>
                      <a href="{{ route('order.show', $order->id) }}">show</a>
                    </label>
                  </div>
                  <div class="col-md-9">
                    <div class="row">
                      <table class="table">
                        @foreach($order->products as $productOrder)
                          <tr>
                            <td>Product name</td>
                            <td>{{ $productOrder->product->title }}</td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>
                  <hr/>
                </div>
              @endforeach
            </div>
            {{-- ADDRESSES TAB--}}
            <div class="tab-pane fade" id="address" role="addresspanel"
                 aria-labelledby="address-tab">
              <div class="row">

                <a class="btn btn-primary"
                   href="{{ route('addresses.create', [\Illuminate\Support\Facades\Auth::id()]) }}">
                  Create
                </a>

                <table class="table">
                  <tr>
                    <th>Postcode</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>House number</th>
                    <th>Actions</th>
                  </tr>
                  @foreach($user->addresses as $address)
                    <tr>
                      <td>{{ $address->postcode }}</td>
                      <td>{{ $address->city }}</td>
                      <td>{{ $address->street }}</td>
                      <td>{{ $address->house_number }}</td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-primary"
                             href="{{ route('addresses.edit', [\Illuminate\Support\Facades\Auth::guard('user')->user()->id, $address->id]) }}"><i
                                class="fas fa-edit"></i></a>
                          <form
                              action="{{ route('addresses.destroy', [\Illuminate\Support\Facades\Auth::guard('user')->user()->id, $address->id]) }}"
                              method="post">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" type="submit"><i
                                  class="fas fa-trash-alt"></i></button>

                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </table>
                <hr/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <style>
    .profile {
      padding: 3%;
      margin-top: 3%;
      margin-bottom: 3%;
      border-radius: 0.5rem;
      background: #fff;
    }

    .profile-edit-btn {
      border: none;
      border-radius: 1.5rem;
      width: 70%;
      padding: 2%;
      font-weight: 600;
      color: #6c757d;
      cursor: pointer;
    }

    .profile .nav-tabs {
      bottom: 0;
    }

    .profile .nav-tabs .nav-link {
      font-weight: 600;
      border: none;
    }

    .profile .nav-tabs .nav-link.active {
      border: none;
      border-bottom: 2px solid #0062cc;
    }

    .profile-work {
      color: #495057;
    }

    .profile-work span {
      text-decoration: none;
      color: #495057;
      font-weight: 600;
      font-size: 14px;
    }

    .profile-tab label {
      font-weight: 600;
    }

    .profile-tab p {
      font-weight: 600;
      color: #0062cc;
    }
  </style>
@endsection
