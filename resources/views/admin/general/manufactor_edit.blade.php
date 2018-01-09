@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 制造商</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.manufactors.index')}}">返回主界面</a>
        </div>

        <div class="col-md-3" align="center">
          <img src="{{$manufactor->logo ? '/images/manufactors/logo/'.$manufactor->logo : '/images/manufactors/logo/placeholder.png'}}"
                        title="{{$manufactor->name}}.logo" class="img-responsive img-rounded" style="width:100px;height:100px;">
          <p>图标请保持 100 X 100 以内</p>
        </div>

        <div class="col-md-6">
          {!! Form::model($manufactor, ['method'=>'PATCH', 'action'=>['Admin\ManufactorController@update', $manufactor->id], 'files'=>true]) !!}
            <div class="modal-body">
                <div class="form-group label-floating">
                    {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                  <label class="control-label" for="country_id">国家</label>
                  <select class="form-control"  name="country_id">
                    <option value ="{{$manufactor->country ? $manufactor->country->id : 0}}" selected>
                                     {{$manufactor->country ? $manufactor->country->name : '请选择国家'}}</option>
                    @foreach($countries as $key => $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label" for="city_id">城市</label>
                  <select class="form-control"  name="city_id">
                    <option value ="{{$manufactor->city ? $manufactor->city->id : 0}}" selected>
                                     {{$manufactor->city ? $manufactor->city->name : '请选择城市'}}</option>
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

            <div class="form-group">
                {!! Form::submit('修改制造商', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\ManufactorController@destroy', $manufactor->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除制造商', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
