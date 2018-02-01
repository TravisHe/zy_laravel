@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title"><strong>{{$menu->name}}</strong> 的所有商品</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddProductModal">添加商品</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>名称</th>
              <th>主分类</th>
              <th>厂商</th>
              <th>销售量</th>
              <th>收藏量</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($products)
                @foreach($products as $key => $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.products_main.edit', $product->id)}}">{{$product->name}}</a></td>
                  <td><a href="{{route('admin.menus.index')}}">{{$product->menu->id}}. {{$product->menu->name}}</a></td>
                  <td><a href="{{route('admin.manufactors.index')}}">{{$product->manufactor->id}}. {{$product->manufactor->name}}</a></td>
                  <td>{{$product->sales ? $product->sales : 0}}</td>
                  <td>{{$product->collects ? $product->collects : 0}}</td>
                  <td>{{$product->created_at ? $product->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.products_main.edit', $product->id)}}" role="button">修改</a>
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
  <!--Admin Product Add Modal -->
  <div class="modal fade" id="adminAddProductModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">商品</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>['Admin\ProductsController@store']]) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="menu_id">主分类</label>
                <select class="form-control"  name="menu_id">
                  @foreach($menus as $key => $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="manufactor_id">厂商</label>
                <select class="form-control"  name="manufactor_id">
                  @foreach($manufactors as $key => $manufactor)
                    <option value="{{$manufactor->id}}">{{$manufactor->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('sales', '销售量', ['class'=>'control-label']) !!}
                  {!! Form::text('sales', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('collects', '收藏量', ['class'=>'control-label']) !!}
                  {!! Form::text('collects', null, ['class'=>'form-control']) !!}
              </div>

          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加商品', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
