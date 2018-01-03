@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 颜色</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.colors.index')}}">返回颜色主界面</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($color, ['method'=>'PATCH', 'action'=>['Products\ProductColorsController@update', $color->id]]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group label-floating">
                <label class="control-label" for="color_code">Color Picker</label>
                <input name="color_code" type="color" value="{{$color->color_code}}"/>
            </div>

            <div class="form-group">
                {!! Form::submit('修改分类', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Products\ProductColorsController@destroy', $color->id]]) !!}
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
