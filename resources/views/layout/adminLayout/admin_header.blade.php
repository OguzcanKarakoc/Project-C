<div id="navbar-wrapper">
  <header>
    <nav class="navbar navbar-light bg-light fixed-top navbar-expand-md" role="navigation">
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        &#x2630;
      </button>
      <a class="navbar-brand" href="{{('/home')}}">GameShop</a>
      <div id="navbar-collapse" class="collapse navbar-collapse">
        <form action="{{ route('ajax-paginate')  }}" class="form-inline my-2 my-lg-0">
          <div class="input-group input-group-sm">
            <input name="search" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search..." value="@if(isset($_GET['search'])){{ $_GET['search'] }}@endif"/>
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary btn-number">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <ul class="nav navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a id="user-profile" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->first_name }} {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->last_name }}
            </a>
            <ul class="dropdown-menu dropdown-block" role="menu">
              <li class="dropdown-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</div>
