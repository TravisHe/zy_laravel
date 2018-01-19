@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 图片资料</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.product_medias.index')}}">返回</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($product, ['method'=>'PATCH', 'action'=>['Products\ProductMediasController@update', $product->id], 'files'=>true]) !!}

            <div class="form-group">
              <label class="control-label" for="product_detail_id">所属商品细节名称</label>
              <select class="form-control"  name="product_detail_id">
                <option value ="{{$product->product->id}}" selected>{{$product->product->name}}</option>
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

            <div class="form-group">
                {!! Form::submit('修改商品', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::model($product, ['method'=>'DELETE', 'action'=>['Products\ProductMediasController@destroy', $product_id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除图片', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
