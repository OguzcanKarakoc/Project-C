<style>

</style>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('home.index') }}">
    <img src="{{ url('Logo.png') }}" style="margin-top: -15px; margin-left: -17px; margin-bottom: -13px; width: 120px; height: 60px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
          aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteNamed('home.index') ? 'active' : '' }}" href="{{ route('home.index') }}">Home</a>
      </li>
      <li class="nav-item active">
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteNamed('ajax-paginate') ? 'active' : '' }}" href="{{ route('ajax-paginate') }}">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Route::currentRouteNamed('contact.index') ? 'active' : '' }}" href="{{ route('contact.index') }}">Contact</a>
      </li>
    </ul>
    <form action="{{ route('ajax-paginate')  }}" class="form-inline my-2 my-lg-0">
      <div class="input-group input-group-sm">
        <input name="search" type="text" class="form-control" aria-label="Small"
               aria-describedby="inputGroup-sizing-sm" placeholder="Search..."
               value="@if(isset($_GET['search'])){{ $_GET['search'] }}@endif"/>
        <div class="input-group-append">
          <button type="submit" class="btn btn-secondary btn-number">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <a class="btn btn-sm ml-3 favimg" href="{{ route('favorites.index') }}">
      <i class="fa fa-heart"></i> Favorites
    </a>
    <a class="btn btn-success btn-sm ml-3" href="{{ route('cart.index') }}">
      <i class="fa fa-shopping-cart"></i> Cart
      <span class="cart-badge badge badge-light">0</span>
    </a>
    @if (Auth::guard('user')->check())
      <a class="btn btn-success btn-sm ml-3" href="{{ route('profile.index') }}">
          Profile
      </a>
      <a class="btn btn-success btn-sm ml-3" href="{{ route('logout') }}">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    @else
      <a class="btn btn-success btn-sm ml-3" href="{{ route('user.signin') }}">
        <i class="fas fa-sign-in-alt"></i> Log In
      </a>
      <a class="btn btn-success btn-sm ml-3" href="{{ route('user.register') }}">
          Register
      </a>
    @endif

  </div>
</nav>
<script>
</script>
