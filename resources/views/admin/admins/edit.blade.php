@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 管理员权限</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.admins.index')}}">返回权限管理界面</a>
        </div>

        <div class="col-md-3" align="center">
          <img <img src="{{$user->avatar ? '/images/avatars/'.$user->avatar : '/images/avatars/placeholder.jpg'}}"
                          title="{{$user->name}}.avatar" class="img-responsive img-rounded" style="width:100px;height:100px;">
          <p>图标请保持 100 X 100 以内</p>
        </div>

        <div class="col-md-6">
          {!! Form::model($user, ['method'=>'PATCH', 'action'=>['Admin\AdminManagersController@update', $user->id], 'files'=>true]) !!}
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
              <label class="control-label" for="job_title">工作职务</label>
              <select class="form-control"  name="job_title">
                <option value ="{{$user->job->id}}" selected>{{$user->job->name}}</option>
                @foreach($job_titles as $key => $job)
                  <option value="{{$job->id}}">{{$job->name}}</option>
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
                {!! Form::submit('修改管理员', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminManagersController@destroy', $user->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除管理员', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
