@extends('layouts.admin')

@section('content')
  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">用户身份</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddRolesModal">增加身份</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($roles)
                @foreach($roles as $key => $role)
                <tr>
                  <td>{{$role->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.roles.edit', $role->id)}}">{{$role->name}}</a></td>
                  <td>{{$role->created_at ? $role->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$role->updated_at ? $role->updated_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop


@section('modal')
  <!--Admin User Roles Add Modal -->
  <div class="modal fade" id="adminAddRolesModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">用户身份</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminRolesController@store']) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建身份', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
