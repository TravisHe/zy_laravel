@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">产品材料</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddMaterialModal">增加材料</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>主分类</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($materials)
                @foreach($materials as $key => $material)
                <tr>
                  <td>{{$material->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.materials.edit', $material->id)}}">{{$material->name}}</a></td>
                  <td><a href="{{route('admin.menus.index')}}">{{$material->menu->id}}. {{$material->menu->name}}</a></td>
                  <td>{{$material->created_at ? $material->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$material->updated_at ? $material->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.materials.edit', $material->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$materials->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@section('modal')
  <!--Admin Product Materials Add Modal -->
  <div class="modal fade" id="adminAddMaterialModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">添加材料</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Products\ProductMaterialsController@store']) !!}
          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="menu_id">主分类</label>
                <select class="form-control"  name="menu_id">
                  <option value ="" selected>请选择主分类</option>
                  @foreach($menus as $key => $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建材料', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
