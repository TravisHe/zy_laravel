<nav class="navbar navbar-transparent navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Material Dashboard</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">dashboard</i>
            <p class="hidden-lg hidden-md">Dashboard</p>
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="material-icons">notifications</i>
            <span class="notification">5</span>
            <p class="hidden-lg hidden-md">Notifications</p>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Mike John responded to your email</a></li>
            <li><a href="#">You have 5 new tasks</a></li>
            <li><a href="#">You're now friend with Andrew</a></li>
            <li><a href="#">Another Notification</a></li>
            <li><a href="#">Another One</a></li>
          </ul>
        </li>
        <li>
          <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
             <i class="material-icons">person</i>{{ Auth::guard('admin')->user()->name }}
             <p class="hidden-lg hidden-md">Profile</p>
          </a>
          <ul class="dropdown-menu dropdown-user">
              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
              <li class="divider"></li>
              <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out fa-fw"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
              </li>
          </ul>
        </li>
      </ul>

      <form class="navbar-form navbar-right" role="search">
        <div class="form-group  is-empty">
          <input type="text" class="form-control" placeholder="Search">
          <span class="material-input"></span>
        </div>
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i><div class="ripple-container"></div>
        </button>
      </form>
    </div>
  </div>
</nav>
