@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 用户</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.users.index')}}">返回用户界面</a>
        </div>

        <div class="col-md-3" align="center">
          <img <img src="{{$user->userDetail ? '/images/avatars/'.$user->userDetail->avatar : '/images/avatars/placeholder.jpg'}}"
                          title="{{$user->name}}.avatar" class="img-responsive img-rounded" style="width:100px;height:100px;">
          <p>图标请保持 100 X 100 以内</p>
        </div>

        <div class="col-md-6">
          {!! Form::model($user, ['method'=>'PATCH', 'action'=>['Admin\AdminUsersController@update', $user->id], 'files'=>true]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group label-floating">
                {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
                {!! Form::text('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="role_id">身份</label>
              <select class="form-control"  name="role_id">
                <option value ="{{$user->role->id}}" selected>{{$user->role->name}}</option>
                @foreach($roles as $key => $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="control-label" for="is_active">激活</label>
              <select class="form-control"  name="is_active">
                <option value ="{{$user->is_active}}" selected>{{$user->is_active == 1 ? '激活' : '未激活'}}</option>
                <option value ="{{$user->is_active == 1 ? 0 : 1}}">{{$user->is_active == 1 ? '未激活' : '激活'}}</option>
              </select>
            </div>

            <div>
                {!! Form::label('avatar', '头像', ['class'=>'control-label']) !!}
                {!! Form::file('avatar', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('修改用户', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminUsersController@destroy', $user->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除用户', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
