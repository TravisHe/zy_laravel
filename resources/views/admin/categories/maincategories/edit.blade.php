@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 一级分类</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.maincategories.index')}}">返回一级分类</a>
        </div>

        <div class="col-md-3" align="center">
          <img src="{{$maincategory->icon ? '/images/icons/'.$maincategory->icon : '/images/icons/placeholder.jpg'}}"
                        title="{{$maincategory->name}}.icon" class="img-responsive img-rounded" style="width:100px;height:100px;">
          <p>图标请保持 50 X 50 以内</p>
        </div>

        <div class="col-md-6">
          {!! Form::model($maincategory, ['method'=>'PATCH', 'action'=>['Admin\AdminMaincategoriesController@update', $maincategory->id], 'files'=>true]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group label-floating">
                {!! Form::label('intro', '简介', ['class'=>'control-label']) !!}
                {!! Form::text('intro', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="menu_id">主分类</label>
              <select class="form-control"  name="menu_id">
                <option value ="{{$maincategory->menu->id}}" selected>{{$maincategory->menu->name}}</option>
                @foreach($menus as $key => $menu)
                  <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
              </select>
            </div>

            <div>
                {!! Form::label('icon', '图标', ['class'=>'control-label']) !!}
                {!! Form::file('icon', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('修改一级分类', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminMaincategoriesController@destroy', $maincategory->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除分类', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
