@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">二级分类</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddSubCategoryModal">增加二级分类</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>名称</th>
              <th>所属一级分类</th>
              <th>所属主分类</th>
              <th>简介</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($subcategories)
                @foreach($subcategories as $key => $subcategory)
                <tr>
                  <td>{{$subcategory->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.subcategories.edit', $subcategory->id)}}">{{$subcategory->name}}</a></td>
                  <td><a href="{{route('admin.maincategories.index')}}">{{$subcategory->maincategory->name}}</a></td>
                  <td><a href="{{route('admin.menus.index')}}">{{$subcategory->maincategory->menu->id}}.
                                                               {{$subcategory->maincategory->menu->name}}</a></td>
                  <td>{{$subcategory->intro}}</td>
                  <td>{{$subcategory->created_at ? $subcategory->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$subcategory->updated_at ? $subcategory->updated_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$subcategories->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('modal')
  <!--Admin Maincategory Add Modal -->
  <div class="modal fade" id="adminAddSubCategoryModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">二级分类</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminSubcategoriesController@store']) !!}

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
                <label class="control-label" for="maincategory_id">一级分类</label>
                <select class="form-control"  name="maincategory_id">
                  <option value ="" selected>请选择一级分类</option>
                  @foreach($maincategories as $key => $maincategory)
                    <option value="{{$maincategory->id}}">{{$maincategory->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建二级分类', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
