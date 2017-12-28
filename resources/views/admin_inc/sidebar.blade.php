<div class="sidebar" data-color="blue" data-image="{{ asset('/images/dashboard/sidebar-1.jpg') }}">
<!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

      Tip 2: you can also add an image using data-image tag
  -->

  <div class="logo">
    <a href="http://www.zanyiu.com" class="simple-text">
      ZanYiu
    </a>
  </div>

  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="active">
        <a href="{{route('admin.dashboard')}}">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>

      <li>
        <a href="user.html">
          <i class="material-icons">person</i>
          <p>User Profile</p>
        </a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">content_paste</i>
            <span>分类</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.menus.index')}}">主分类</a></li>
          <li><a href="#">一级分类</a></li>
          <li><a href="#">二级分类</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>

      <li>
        <a href="typography.html">
          <i class="material-icons">library_books</i>
          <p>Typography</p>
        </a>
      </li>

      <li>
        <a href="icons.html">
          <i class="material-icons">bubble_chart</i>
          <p>Icons</p>
        </a>
      </li>

      <li>
        <a href="maps.html">
          <i class="material-icons">location_on</i>
          <p>Maps</p>
        </a>
      </li>

      <li>
        <a href="notifications.html">
          <i class="material-icons text-gray">notifications</i>
          <p>Notifications</p>
        </a>
      </li>

      <li class="active-pro">
        <a href="upgrade.html">
          <i class="material-icons">unarchive</i>
          <p>Upgrade to PRO</p>
        </a>
      </li>
    </ul>
  </div>
</div>