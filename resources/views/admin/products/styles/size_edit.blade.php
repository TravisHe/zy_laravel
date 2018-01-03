@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 尺寸</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.sizes.index')}}">返回尺寸主界面</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($size, ['method'=>'PATCH', 'action'=>['Products\ProductSizesController@update', $size->id]]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="menu_id">主分类</label>
              <select class="form-control"  name="menu_id">
                <option value ="{{$size->menu->id}}" selected>{{$size->menu->name}}</option>
                @foreach($menus as $key => $menu)
                  <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                {!! Form::submit('修改分类', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Products\ProductSizesController@destroy', $size->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除尺寸', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
