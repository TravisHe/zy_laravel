@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 二级分类</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.subcategories.index')}}">返回主分类</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($subcategory, ['method'=>'PATCH', 'action'=>['Admin\AdminSubcategoriesController@update', $subcategory->id]]) !!}
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
                <option value ="{{$subcategory->maincategory->id}}" selected>{{$subcategory->maincategory->name}}</option>
                @foreach($maincategories as $key => $maincategory)
                  <option value="{{$maincategory->id}}">{{$maincategory->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                {!! Form::submit('修改分类', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminSubcategoriesController@destroy', $subcategory->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除分类', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
