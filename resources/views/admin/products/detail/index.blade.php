@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">所有商品</h4>
          <span class="category">Here is a subtitle for this table</span>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>细节名称(可不写)</th>
              <th>主要信息名称</th>
              <th>所属主分类</th>
              <th>商品颜色</th>
              <th>商品大小</th>
              <th>商品材料</th>
              <th>价格</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($products)
                @foreach($products as $key => $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td class="text-primary">{{$product->name ? $product->name : $product->product->name}}</td>
                  <td class="text-primary"><a href="#">{{$product->product->id}}. {{$product->product->name}}</a></td>
                  <td><a href="{{route('admin.menus.index')}}">{{$product->menu->id}}. {{$product->menu->name}}</a></td>
                  <td><a href="{{route('admin.colors.index')}}">{{$product->color ? $product->color->id .". ".
                                                                  $product->color->name : 'No Colors'}}</a></td>
                  <td><a href="{{route('admin.sizes.index')}}">{{$product->size ? $product->size->id .". ".
                                                                 $product->size->name : 'No Sizes'}}</a></td>
                  <td><a href="{{route('admin.materials.index')}}">{{$product->material ? $product->material->id .". ".
                                                                     $product->material->name : 'No Materials'}}</a></td>
                  <td>{{$product->price ? $product->price : 'No Price'}}</td>
                  <td>{{$product->created_at ? $product->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.products_detail.edit', $product->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$products->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('modal')
@stop
