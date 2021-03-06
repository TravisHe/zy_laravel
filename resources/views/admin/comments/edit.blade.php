@extends('layouts.admin')

@section('content')

  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">修改·删除 评论</h4>
          <span class="category">Here is a subtitle for this table</span>
          <a type="button" class="btn btn-info btn-lg" href="{{route('admin.comments.index')}}">返回评论</a>
        </div>

        <div class="col-sm-3"></div>

        <div class="col-md-6">
          {!! Form::model($comment, ['method'=>'PATCH', 'action'=>['Admin\CommentsController@update', $comment->id]]) !!}
            <input type="hidden" name="product_id" value="{{$comment->product_id}}">

            <input type="hidden" name="author" value="{{$comment->author}}">

            <div class="form-group label-floating">
                {!! Form::label('body', '评论内容', ['class'=>'control-label']) !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
              <label class="control-label" for="is_active">激活</label>
              <select class="form-control"  name="is_active">
                <option value ="{{$comment->is_active}}" selected>{{$comment->is_active == 1 ? '激活' : '未激活'}}</option>
                <option value ="{{$comment->is_active == 1 ? 0 : 1}}">{{$comment->is_active == 1 ? '未激活' : '激活'}}</option>
              </select>
            </div>


            <div class="form-group">
                {!! Form::submit('修改评论', ['class'=>'btn btn-primary col-md-6']) !!}
            </div>
          {!! Form::close() !!}


          {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\CommentsController@destroy', $comment->id]]) !!}
            <div class="form-group" style="margin-top:-30px;">
                {!! Form::submit('删除评论', ['class'=>'btn btn-danger col-md-5 confirm', 'data-confirm'=>'确认删除？']) !!}
            </div>
          {!! Form::close() !!}
        </div>

        <div class="col-sm-3"></div>
      </div>
    </div>
  </div>

@stop
