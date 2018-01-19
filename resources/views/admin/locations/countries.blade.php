@extends('layouts.admin')

@section('content')
  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">国家</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddCountryModal">增加国家</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>Id</th>
              <th>Name</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($countries)
                @foreach($countries as $key => $country)
                <tr>
                  <td>{{$country->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.countries.edit', $country->id)}}">{{$country->name}}</a></td>
                  <td>{{$country->created_at ? $country->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$country->updated_at ? $country->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.countries.edit', $country->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$countries->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@section('modal')
  <!--Admin Countries Add Modal -->
  <div class="modal fade" id="adminAddCountryModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">国家</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\CountriesController@store']) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加国家', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
