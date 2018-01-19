@extends('layouts.admin')

@section('content')

  @include('includes.flash_session')
  @include('includes.form_error')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" data-background-color="purple">
          <h4 class="title">所有评论</h4>
          <span class="category">Here is a subtitle for this table</span>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>评论用户</th>
              <th>评论商品</th>
              <th>评论内容</th>
              <th>回复人</th>
              <th>回复内容</th>
              <th>回复是否激活</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($comment_replies)
                @foreach($comment_replies as $key => $reply)
                <tr>
                  <td>{{$reply->id}}</td>
                  <td class="text-primary"><a href="#">{{$reply->comment->user->id}}. {{$reply->comment->user->name}}</a></td>
                  <td><a href="#">{{$reply->comment->product->id}}. {{$reply->comment->product->name}}</a></td>
                  <td>{{str_limit($reply->comment->body, 20)}}</td>
                  <td>{{$reply->user->id}}. {{$reply->user->name}}</td>
                  <td>{{str_limit($reply->body, 20)}}</td>
                  <td>{{$reply->is_active == 1 ? '激活' : '未激活'}}</td>
                  <td>{{$reply->created_at ? $reply->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$reply->updated_at ? $reply->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.comment_replies.edit', $reply->id)}}" role="button">修改</a></td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$comment_replies->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('modal')
@stop
