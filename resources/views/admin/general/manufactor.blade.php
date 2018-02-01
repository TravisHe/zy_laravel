@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">制造商</h4>
          <span class="category">Here is a subtitle for this table</span>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddManufactorModal">添加制造商</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>logo</th>
              <th>名称</th>
              <th>城市</th>
              <th>国家</th>
              <th>地址</th>
              <th>phone</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($manufactors)
                @foreach($manufactors as $key => $manufactor)
                <tr>
                  <td>{{$manufactor->id}}</td>
                  <td><img src="{{$manufactor->logo ? '/images/manufactors/logo/'.$manufactor->logo : '/images/manufactors/logo/placeholder.png'}}"
                                  title="{{$manufactor->name}}.logo" style="width:25px;height:25px;" ></td>
                  <td class="text-primary"><a href="{{route('admin.manufactors.edit', $manufactor->id)}}">{{$manufactor->name}}</a></td>
                  <td><a href="{{route('admin.cities.index')}}">{{$manufactor->city ? $manufactor->city->id  .'.'.
                                                                  $manufactor->city->name : 'No City'}}</a></td>
                  <td><a href="{{route('admin.countries.index')}}">{{$manufactor->country->id}}. {{$manufactor->country->name}}</a></td>
                  <td>{{$manufactor->address ? $manufactor->address : 'No Address'}}</td>
                  <td>{{$manufactor->phone ? $manufactor->phone : 'No Phone'}}</td>
                  <td>{{$manufactor->created_at ? $manufactor->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$manufactor->updated_at ? $manufactor->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs btn-modify" href="{{route('admin.manufactors.edit', $manufactor->id)}}" role="button">修改</a>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$manufactors->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('modal')
  <!--Admin Manufactor Add Modal -->
  <div class="modal fade" id="adminAddManufactorModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">制造商</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\ManufactorController@store', 'files'=>true]) !!}

          <div class="modal-body">
              <div class="form-group label-floating">
                  {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="country_id">国家</label>
                <select class="form-control"  name="country_id">
                  <option value ="" selected>请选择国家</option>
                  @foreach($countries as $key => $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="city_id">城市</label>
                <select class="form-control"  name="city_id">
                  <option value ="" selected>请选择城市</option>
                  @foreach($cities as $key => $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('address', '地址', ['class'=>'control-label']) !!}
                  {!! Form::text('address', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('phone', '电话', ['class'=>'control-label']) !!}
                  {!! Form::text('phone', null, ['class'=>'form-control']) !!}
              </div>

              <div>
                  {!! Form::label('logo', 'logo', ['class'=>'control-label']) !!}
                  {!! Form::file('logo', null, ['class'=>'form-control']) !!}
              </div>
          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加制造商', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop
