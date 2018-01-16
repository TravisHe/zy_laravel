@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">{{$menu->name}}的所有商品</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddProductModal">添加商品</button>
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
            </thead>

            <tbody>
              @if($products)
                @foreach($products as $key => $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.products_detail.edit', $product->id)}}">
                                                    {{$product->name ? $product->name : $product->product->name}}</a></td>
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

        {!! Form::open(['method'=>'POST', 'action'=>['Admin\ProductDetailsController@store']]) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '细节名称(可不写)', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>
              
              <div class="form-group">
                <label class="control-label" for="product_id">所属商品主要信息</label>
                <select class="form-control"  name="product_id">
                  @foreach($products_main as $key => $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                  @endforeach
                </select>
              </div>

              <input type="hidden" name="menu_id" value="{{$menu->id}}">

              <div class="form-group">
                <label class="control-label" for="product_color_id">颜色</label>
                <select class="form-control"  name="product_color_id">
                  <option value ="" selected>请选择颜色</option>
                  @foreach($product_colors as $key => $color)
                    <option value="{{$color->id}}">{{$color->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="product_size_id">大小</label>
                <select class="form-control"  name="product_size_id">
                  <option value ="" selected>请选择大小</option>
                  @foreach($product_sizes as $key => $size)
                    <option value="{{$size->id}}">{{$size->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="product_material_id">大小</label>
                <select class="form-control"  name="product_material_id">
                  <option value ="" selected>请选择材质</option>
                  @foreach($product_materials as $key => $material)
                    <option value="{{$material->id}}">{{$material->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group label-floating">
                <label class="control-label" for="price">价格</label>
                <input type="number" min="1" step="any" name="price" class="form-control"/>
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
