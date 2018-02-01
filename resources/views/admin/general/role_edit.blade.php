@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 用户身份</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.roles.index')}}">返回用户身份主页面</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($role, ['method'=>'PATCH', 'action'=>['Admin\AdminRolesController@update', $role->id]]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('修改身份', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminRolesController@destroy', $role->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除身份', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
