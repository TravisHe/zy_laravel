@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">产品颜色</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddColorModal">增加颜色</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>颜色</th>
              <th>名称</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($colors)
                @foreach($colors as $key => $color)
                <tr>
                  <td>{{$color->id}}</td>
                  <td><a href="{{route('admin.colors.edit', $color->id)}}">
                      <div style="background-color:{{$color->color_code}}" class="productColor"></div></a></td>
                  <td class="text-primary"><a href="{{route('admin.colors.edit', $color->id)}}">{{$color->name}}</a></td>
                  <td>{{$color->created_at ? $color->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$color->updated_at ? $color->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.colors.edit', $color->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$colors->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@section('modal')
  <!--Admin Product Colors Add Modal -->
  <div class="modal fade" id="adminAddColorModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">添加颜色</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Products\ProductColorsController@store']) !!}
          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group label-floating">
                  <label class="control-label" for="color_code">Color Picker</label>
                  <input name="color_code" type="color"/>
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('创建颜色', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
