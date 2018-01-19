@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">所有商品的图片资料</h4>
          <span class="category">Here is a subtitle for this table</span>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>所属主分类</th>
              <th>所属商品主要名称</th>
              <th>所属商品细节名称</th>
              <th>图片1</th>
              <th>图片2</th>
              <th>图片3</th>
              <th>图片4</th>
              <th>图片5</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($product_media)
                @foreach($product_media as $key => $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td><a href="{{route('admin.menus.index')}}">{{$product->menu->id}}. {{$product->menu->name}}</a></td>
                  <td class="text-primary"><a href="#">{{$product->product->product->id}}. {{$product->product->product->name}}</a></td>
                  <td><a href="{{route('admin.products_detail.index')}}">{{is_null($product->product->name) ? $product->product->product->id
                               .". ". $product->product->product->name : $product->product->id .". ". $product->product->name}}</a></td>
                  <td><img src="{{$product->media_1 ? '/images/products/show_image/'.$product->media_1 : '/images/products/show_image/null.png'}}"
                                                  style="width:40px;height:40px;" ></td>
                  <td><img src="{{$product->media_2 ? '/images/products/show_image/'.$product->media_2 : '/images/products/show_image/null.png'}}"
                                                  style="width:40px;height:40px;" ></a></td>
                  <td><img src="{{$product->media_3 ? '/images/products/show_image/'.$product->media_3 : '/images/products/show_image/null.png'}}"
                                                  style="width:40px;height:40px;" ></a></td>
                  <td><img src="{{$product->media_4 ? '/images/products/show_image/'.$product->media_4 : '/images/products/show_image/null.png'}}"
                                                  style="width:40px;height:40px;" ></a></td>
                  <td><img src="{{$product->media_5 ? '/images/products/show_image/'.$product->media_5 : '/images/products/show_image/null.png'}}"
                                                  style="width:40px;height:40px;" ></a></td>
                  <td>{{$product->created_at ? $product->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.product_medias.edit', $product->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$product_media->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('modal')
@stop
