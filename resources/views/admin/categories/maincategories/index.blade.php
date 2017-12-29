@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">一级分类</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddMainCategoryModal">增加一级分类</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>图标</th>
              <th>名称</th>
              <th>简介</th>
              <th>所属主分类</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($maincategories)
                @foreach($maincategories as $key => $maincategory)
                <tr>
                  <td>{{$maincategory->id}}</td>
                  <td><img src="{{$maincategory->icon ? '/images/icons/'.$maincategory->icon : '/images/icons/placeholder.jpg'}}"
                                  title="{{$maincategory->name}}.icon" style="width:25px;height:25px;" ></td>
                  <td class="text-primary"><a href="{{route('admin.maincategories.edit', $maincategory->id)}}">{{$maincategory->name}}</a></td>
                  <td>{{$maincategory->intro}}</td>
                  <td><a href="{{route('admin.menus.index')}}">{{$maincategory->menu->id}}. {{$maincategory->menu->name}}</a></td>
                  <td>{{$maincategory->created_at ? $maincategory->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$maincategory->updated_at ? $maincategory->updated_at->diffForHumans() : 'No Date'}}</td>
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
  <!--Admin Maincategory Add Modal -->
  <div class="modal fade" id="adminAddMainCategoryModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">一级分类</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminMaincategoriesController@store', 'files'=>true]) !!}

          <div class="modal-body">
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
                  <option value ="" selected>请选择主分类</option>
                  @foreach($menus as $key => $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                  @endforeach
                </select>
              </div>

              <div>
                  {!! Form::label('icon', '图标', ['class'=>'control-label']) !!}
                  {!! Form::file('icon', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建一级分类', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
