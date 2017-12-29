@extends('layouts.admin')

@section('content')
  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">主分类</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddMenuModal">增加主分类</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>Intro</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($menus)
                @foreach($menus as $key => $menu)
                <tr>
                  <td>{{$menu->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.menus.edit', $menu->id)}}">{{$menu->name}}</a></td>
                  <td>{{$menu->intro}}</td>
                  <td>{{$menu->created_at ? $menu->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$menu->updated_at ? $menu->updated_at->diffForHumans() : 'No Date'}}</td>
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
  <!--Admin Menus Add Modal -->
  <div class="modal fade" id="adminAddMenuModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">主分类</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminMenusController@store']) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('intro', '简介', ['class'=>'control-label']) !!}
                  {!! Form::text('intro', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建分类', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
