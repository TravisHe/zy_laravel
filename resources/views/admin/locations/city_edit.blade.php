@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 城市</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.cities.index')}}">返回城市主界面</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($city, ['method'=>'PATCH', 'action'=>['Admin\CitiesController@update', $city->id]]) !!}
            <div class="form-group label-floating">
                {!! Form::label('name', '名称', ['class'=>'control-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="country_id">请选择国家</label>
              <select class="form-control"  name="country_id">
                @if($city->country)
                  <option value ="{{$city->country->id}}" selected>{{$city->country->name}}</option>
                @else
                  <option value ="" selected>请选择国家</option>
                @endif
                @foreach($countries as $key => $country)
                  <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                {!! Form::submit('修改城市', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\CitiesController@destroy', $city->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除城市', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
