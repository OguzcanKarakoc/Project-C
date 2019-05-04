@extends('layout.app')

@section('content')

  <div class="container profile">
    @include('component.flash-message')
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            {{--<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" class="w-100"/>--}}
          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <h5>
              {{ $user->first_name }} {{ $user->last_name }}
            </h5>
            <h6>
              joined at : {{ $user->created_at->format('d M Y') }}
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
                 aria-controls="profile" aria-selected="false">Timeline Orders</a>
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
                  <div class="col-md-6">
                    <label>Order: {{ $order->id }}</label>
                  </div>
                  <div class="col-md-6">
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
                  <hr />
                </div>
              @endforeach
            </div>
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <table class="table">
                        <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">postcode</th>
                          <th scope="col">city</th>
                          <th scope="col">street</th>
                          <th scope="col">house_number</th>
                          <th scope="col">delivery_address</th>
                          <th scope="col">user_id</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->addresses as $address)
                          <tr>
                            <td>{{ $address->id }}</td>
                            <td>{{ $address->postcode }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->street }}</td>
                            <td>{{ $address->house_number }}</td>
                            <td>{{ $address->delivery_address}}</td>
                            <td>{{ $address->user_id}}</td>

                            <td>
                              <div class="btn-group" role="group">
                                <a href="{{ route('addresses.edit', [$user->id, $address->id] )  }}" class="btn btn-info">Edit</a>
                                <form action="{{ route('addresses.destroy', [$user->id, $address->id]) }}" method="post">
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
                    </div>
                  </div>
                  <hr />
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
