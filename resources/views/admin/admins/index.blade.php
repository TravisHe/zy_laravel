@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">所有管理员</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddAdminModal">增加管理员</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>头像</th>
              <th>名称</th>
              <th>Email</th>
              <th>工作岗位</th>
              <th>Status</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($users)
                @foreach($users as $key => $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td><img src="{{$user->avatar ? '/images/avatars/'.$user->avatar : '/images/avatars/placeholder.jpg'}}"
                                  title="{{$user->name}}.avatar" style="width:25px;height:25px;" ></td>
                  <td class="text-primary"><a href="{{route('admin.admins.edit', $user->id)}}">{{$user->name}}</a></td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->job->name}}</td>
                  <td>{{$user->is_active == 1 ? 'Active' : 'No Active'}}</td>
                  <td>{{$user->created_at ? $user->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$users->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop


@section('modal')

  <!--Admin 管理员权限 Add Modal -->
  <div class="modal fade" id="adminAddAdminModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">添加管理员</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminManagersController@store', 'files'=>true]) !!}

          <div class="modal-body">
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
                <label class="control-label" for="job_title">工作岗位</label>
                <select class="form-control"  name="job_title">
                  <option value ="" selected>请选择工作</option>
                  @foreach($job_titles as $key => $job)
                    <option value="{{$job->id}}">{{$job->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="is_active">激活</label>
                <select class="form-control"  name="is_active">
                  <option value ="0" selected>未激活</option>
                  <option value ="1">激活</option>
                </select>
              </div>

              <div>
                  {!! Form::label('avatar', '头像', ['class'=>'control-label']) !!}
                  {!! Form::file('avatar', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建管理员', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>

@stop
