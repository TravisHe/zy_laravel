@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">产品大小</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddSizeModal">增加尺寸</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>主分类</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($sizes)
                @foreach($sizes as $key => $size)
                <tr>
                  <td>{{$size->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.sizes.edit', $size->id)}}">{{$size->name}}</a></td>
                  <td><a href="{{route('admin.menus.index')}}">{{$size->menu->id}}. {{$size->menu->name}}</a></td>
                  <td>{{$size->created_at ? $size->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$size->updated_at ? $size->updated_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$sizes->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@section('modal')
  <!--Admin Product Sizes Add Modal -->
  <div class="modal fade" id="adminAddSizeModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">添加尺寸</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Products\ProductSizesController@store']) !!}
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
                {!! Form::submit('创建尺寸', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
