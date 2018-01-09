@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">城市</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddCityModal">添加城市</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>名称</th>
              <th>所属国家</th>
              <th>Created_at</th>
              <th>Updated_at</th>
            </thead>

            <tbody>
              @if($cities)
                @foreach($cities as $key => $city)
                <tr>
                  <td>{{$city->id}}</td>
                  <td class="text-primary"><a href="{{route('admin.cities.edit', $city->id)}}">{{$city->name}}</a></td>
                  @if($city->country)
                    <td><a href="{{route('admin.countries.index')}}">{{$city->country->id}}. {{$city->country->name}}</a></td>
                  @else
                    <td>请选择国家</td>
                  @endif
                  <td>{{$city->created_at ? $city->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$city->updated_at ? $city->updated_at->diffForHumans() : 'No Date'}}</td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$cities->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('modal')
  <!--Admin City Add Modal -->
  <div class="modal fade" id="adminAddCityModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">添加城市</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\CitiesController@store']) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '城市', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="country_id">所属国家</label>
                <select class="form-control"  name="country_id">
                  <option value ="" selected>请选择国家</option>
                  @foreach($countries as $key => $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加城市', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
