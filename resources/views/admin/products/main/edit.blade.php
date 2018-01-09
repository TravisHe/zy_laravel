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
          {!! Form::model($product, ['method'=>'PATCH', 'action'=>['Admin\ProductsController@update', $product->id]]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
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
              <label class="control-label" for="manufactor_id">厂商</label>
              <select class="form-control"  name="manufactor_id">
                <option value ="{{$product->manufactor ? $product->manufactor->id : 0}}" selected>
                                 {{$product->manufactor ? $product->manufactor->name : '请选择厂商'}}</option>
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

            <div class="form-group">
                {!! Form::submit('修改商品', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\ProductsController@destroy', $product->id]]) !!}
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
