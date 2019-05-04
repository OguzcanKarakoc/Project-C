<div id="sidebar-wrapper">
  <aside id="sidebar">
    <ul id="sidemenu" class="sidebar-nav">
      <li><a href="{{('/admin/dashboard')}}">
          <span class="sidebar-icon"><i class="fas fa-home"></i></span>
          <span class="sidebar-title">Home</span>
        </a>
      </li>
      <li>
        <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-2">
          <span class="sidebar-icon"><i class="fa fa-users"></i></span>
          <span class="sidebar-title">Users</span>
          <b class="caret"></b>
        </a>
        <ul id="submenu-2" class="panel-collapse collapse panel-switch" role="menu">
          <li><a href="{{('/admin/users')}}"><i class="fa fa-caret-right"></i>Users</a></li>
          <li><a href="{{('/admin/roles')}}"><i class="fa fa-caret-right"></i>Roles</a></li>
          <li><a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-6"></a>
            <ul id="submenu-6" class="panel-collapse collapse panel-switch" role="menu">
              <li><a href="{{('/admin/users')}}"><i class="fa fa-caret-right"></i>Users</a></li>
              <li><a href="{{('/admin/roles')}}"><i class="fa fa-caret-right"></i>Roles</a></li>
              <li><a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-6"></a></li>
            </ul>
          </li>

        </ul>
      </li>
      <li><a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-3">
          <span class="sidebar-icon"><i class="fas fa-archive"></i></span>
          <span class="sidebar-title">Products</span>
          <b class="caret"></b>
        </a>
        <ul id="submenu-3" class="panel-collapse collapse panel-switch"            role="menu">
          <li><a href="{{('/admin/products')}}"><i class="fa fa-caret-right"></i>Product</a>          </li>
          <li><a href="{{('/admin/productStatuses')}}"><i class="fa fa-caret-right"></i>Product Status</a>          </li>
        </ul>
      </li>
      <li><a href="{{('/admin/suppliers')}}">
          <span class="sidebar-icon"><i class="fas fa-car-side"></i></span>
          <span class="sidebar-title">Suppliers</span>
        </a>

      </li>


      <li>
        <a href="{{('/admin/orderStatuses')}}">
          <span class="sidebar-icon"><i class="fas fa-file-invoice"></i></span>
          <span class="sidebar-title">Order status</span>
        </a>
      </li>

      <li>
        <a href="{{('/admin/orders')}}">
          <span class="sidebar-icon"><i class="fas fa-file-invoice"></i></span>
          <span class="sidebar-title">Orders</span>
        </a>
      </li>

      <li><a href="{{('/admin/categories')}}">
          <span class="sidebar-icon"><i class="fas fa-sitemap"></i></span>
          <span class="sidebar-title">Categories</span>
        </a>
      </li>
      <li><a href="{{('/admin/tags')}}">
          <span class="sidebar-icon"><i class="fas fa-tags"></i></span>
          <span class="sidebar-title">Tags</span>
        </a>
      </li>
        <li><a href="{{('/admin/shipments')}}">
                <span class="sidebar-icon"><i class="fas fa-truck"></i></span>
                <span class="sidebar-title">Shipments</span>
            </a>
        </li>
    </ul>
  </aside>
</div>
