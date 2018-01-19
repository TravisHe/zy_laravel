<div class="sidebar" data-color="purple" data-image="{{ asset('/images/dashboard/sidebar-1.jpg') }}">
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

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">person</i>
            <span>用户</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.users.index')}}">所有用户</a></li>
          <li><a href="{{route('admin.users.vips')}}">VIP</a></li>
          <li><a href="{{route('admin.users.admins')}}">管理员</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">content_paste</i>
            <span>分类</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.menus.index')}}">主分类</a></li>
          <li><a href="{{route('admin.maincategories.index')}}">一级分类</a></li>
          <li><a href="{{route('admin.subcategories.index')}}">二级分类</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">location_on</i>
            <span>通用信息</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.countries.index')}}">编辑国家</a></li>
          <li><a href="{{route('admin.cities.index')}}">编辑城市</a></li>
          <li><a href="{{route('admin.manufactors.index')}}">制造商</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">library_books</i>
            <span>产品属性</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.colors.index')}}">编辑颜色</a></li>
          <li><a href="{{route('admin.sizes.index')}}">编辑尺寸</a></li>
          <li><a href="{{route('admin.materials.index')}}">编辑材料</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">bubble_chart</i>
            <span>商品主要信息</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          @if($menus)
            @foreach($menus as $key => $menu)
            <li><a href="/zen/menu/{{$menu->id}}/products">{{$menu->name}}</a></li>
            @endforeach
          @endif
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">notifications</i>
            <span>商品细节内容</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.products_detail.index')}}">所有商品</a></li>
          <li role="separator" class="divider"></li>
          @if($menus)
            @foreach($menus as $key => $menu)
            <li><a href="/zen/menu/{{$menu->id}}/product_details">{{$menu->name}}</a></li>
            @endforeach
          @endif
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">3d_rotation</i>
            <span>商品图片资料</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.product_medias.index')}}">所有图片</a></li>
          <li role="separator" class="divider"></li>
          @if($menus)
            @foreach($menus as $key => $menu)
            <li><a href="/zen/menu/{{$menu->id}}/product_medias">{{$menu->name}}</a></li>
            @endforeach
          @endif
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">feedback</i>
            <span>商品评论</span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('admin.comments.index')}}">所有商品评论</a></li>
          <li><a href="{{route('admin.comment_replies.index')}}">所有评论回复</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
