@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 商品</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{ URL::previous() }}">返回</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($product, ['method'=>'PATCH', 'action'=>['Admin\ProductDetailsController@update', $product->id]]) !!}

            <div class="form-group label-floating">
                {!! Form::label('name', '细节名称(可不写)', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="product_id">所属商品主要信息</label>
              <select class="form-control"  name="product_id">
                <option value ="{{$product->product ? $product->product->id : 0}}" selected>
                                 {{$product->product ? $product->product->name : '请选择主要信息'}}</option>
                @foreach($products_main as $key => $product)
                  <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="control-label" for="menu_id">主分类</label>
              <select class="form-control"  name="menu_id">
                <option value ="{{$product->menu ? $product->menu->id : 0}}" selected>
                                {{$product->menu ? $product->menu->name : '请选择分类'}}</option>
                @foreach($menus as $key => $menu)
                  <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="control-label" for="product_color_id">颜色</label>
              <select class="form-control"  name="product_color_id">
                <option value ="{{$color ? $color->id : 0}}" selected>
                                 {{$color ? $color->name : '请选择颜色'}}</option>
                @foreach($product_colors as $key => $color)
                  <option value="{{$color->id}}">{{$color->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="control-label" for="product_size_id">大小</label>
              <select class="form-control"  name="product_size_id">
                <option value ="{{$size ? $size->id : 0}}" selected>
                                 {{$size ? $size->name : '请选择大小'}}</option>
                @foreach($product_sizes as $key => $size)
                  <option value="{{$size->id}}">{{$size->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="control-label" for="product_material_id">大小</label>
              <select class="form-control"  name="product_material_id">
                <option value ="{{$material ? $material->id : 0}}" selected>
                                 {{$material ? $material->name : '请选择材质'}}</option>
                @foreach($product_materials as $key => $material)
                  <option value="{{$material->id}}">{{$material->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group label-floating">
              <label class="control-label" for="price">价格</label>
              <input type="number" min="1" step="any" name="price" value="{{$price}}"/>
            </div>

            <div class="form-group">
                {!! Form::submit('修改商品', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\ProductDetailsController@destroy', $product->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除商品', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
