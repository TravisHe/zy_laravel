@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">{{$menu->name}}的所有商品的图片资料</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddProductMediaModal">添加图片资料</button>
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
                  <td><img src="{{$product->media_1 ? '/images/products/show_image/'.$product->media_1 :
                                  '/images/products/show_image/null.png'}}" style="width:40px;height:40px;" ></td>
                  <td><img src="{{$product->media_2 ? '/images/products/show_image/'.$product->media_2 :
                                  '/images/products/show_image/null.png'}}" style="width:40px;height:40px;" ></td>
                  <td><img src="{{$product->media_3 ? '/images/products/show_image/'.$product->media_3 :
                                  '/images/products/show_image/null.png'}}" style="width:40px;height:40px;" ></td>
                  <td><img src="{{$product->media_4 ? '/images/products/show_image/'.$product->media_4 :
                                  '/images/products/show_image/null.png'}}" style="width:40px;height:40px;" ></td>
                  <td><img src="{{$product->media_5 ? '/images/products/show_image/'.$product->media_5 :
                                  '/images/products/show_image/null.png'}}" style="width:40px;height:40px;" ></td>
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
  <!--Admin Product Meida Add Modal -->
  <div class="modal fade" id="adminAddProductMediaModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">图片资料</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Products\ProductMediasController@store', 'files'=>true]) !!}

          <div class="modal-body">

              <div class="form-group">
                <label class="control-label" for="product_detail_id">所属商品细节名称</label>
                <select class="form-control"  name="product_detail_id">
                  @foreach($products as $key => $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                  @endforeach
                </select>
              </div>

              <input type="hidden" name="menu_id" value="{{$menu->id}}">

              <div>
                  {!! Form::label('media_1', '图片1', ['class'=>'control-label']) !!}
                  {!! Form::file('media_1', null, ['class'=>'form-control']) !!}
              </div>

              <div>
                  {!! Form::label('media_2', '图片2', ['class'=>'control-label']) !!}
                  {!! Form::file('media_2', null, ['class'=>'form-control']) !!}
              </div>

              <div>
                  {!! Form::label('media_3', '图片3', ['class'=>'control-label']) !!}
                  {!! Form::file('media_3', null, ['class'=>'form-control']) !!}
              </div>

              <div>
                  {!! Form::label('media_4', '图片4', ['class'=>'control-label']) !!}
                  {!! Form::file('media_4', null, ['class'=>'form-control']) !!}
              </div>

              <div>
                  {!! Form::label('media_5', '图片5', ['class'=>'control-label']) !!}
                  {!! Form::file('media_5', null, ['class'=>'form-control']) !!}
              </div>

          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加图片', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
