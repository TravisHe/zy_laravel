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
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#adminAddCommentsModal">添加评论</button>
        </div>
        <div class="card-content table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID</th>
              <th>评论用户</th>
              <th>用户邮箱</th>
              <th>评论内容</th>
              <th>评论商品</th>
              <th>是否激活</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>操作</th>
            </thead>

            <tbody>
              @if($comments)
                @foreach($comments as $key => $comment)
                <tr>
                  <td>{{$comment->id}}</td>
                  <td class="text-primary"><a href="#">{{$comment->user->id}}. {{$comment->user->name}}</a></td>
                  <td>{{$comment->user->email}}</td>
                  <td>{{str_limit($comment->body, 20)}}</td>
                  <td><a href="#">{{$comment->product->id}}. {{$comment->product->name}}</a></td>
                  <td>{{$comment->is_active == 1 ? '激活' : '未激活'}}</td>
                  <td>{{$comment->created_at ? $comment->created_at->diffForHumans() : 'No Date'}}</td>
                  <td>{{$comment->updated_at ? $comment->updated_at->diffForHumans() : 'No Date'}}</td>
                  <td><a class="btn btn-info btn-xs" href="{{route('admin.comments.edit', $comment->id)}}" role="button">修改</a>
                  @if(count($comment->replies)>0)
                      <a class="btn btn-secondary btn-xs" role="button" data-toggle="modal"
                                data-commentid="{{$comment->id}}" data-target="#AddCommentRepliesModal">已回复</a></td>                  
                  @else
                      <a class="btn btn-danger btn-xs" role="button" data-toggle="modal"
                                data-commentid="{{$comment->id}}" data-target="#AddCommentRepliesModal">回复</a></td>
                  @endif
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-5">
            {{$comments->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('modal')
  <!--Admin Product Comments Add Modal -->
  <div class="modal fade" id="adminAddCommentsModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">评论</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>['Admin\CommentsController@store']]) !!}

          <div class="modal-body">
              <div class="form-group">
                <label class="control-label" for="author">author</label>
                <select class="form-control"  name="author">
                  <option value ="" selected>请选择用户</option>
                  @foreach($users as $key => $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="product_id">商品</label>
                <select class="form-control"  name="product_id">
                  <option value ="" selected>请选择商品</option>
                  @foreach($products as $key => $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group label-floating">
                  {!! Form::label('body', '评论内容', ['class'=>'control-label']) !!}
                  {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="is_active">激活</label>
                <select class="form-control"  name="is_active">
                  <option value ="0" selected>未激活</option>
                  <option value ="1">激活</option>
                </select>
              </div>

          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加评论', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>

  <!---Admin Product Comment Replies Add Modal -------------------------->
  <div class="modal fade" id="AddCommentRepliesModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">评论回复</h4>
        </div>

        {!! Form::open(['method'=>'POST', 'action'=>['Admin\CommentRepliesController@store']]) !!}

          <div class="modal-body">
              <input type="hidden" name="comment_id" id="comment_id"/>

              <div class="form-group label-floating">
                  {!! Form::label('body', '回复内容', ['class'=>'control-label']) !!}
                  {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
              </div>

              <div class="form-group">
                <label class="control-label" for="is_active">激活</label>
                <select class="form-control"  name="is_active">
                  <option value ="0" selected>未激活</option>
                  <option value ="1">激活</option>
                </select>
              </div>

          </div>

          <div class="modal-footer">
            <div class="form-group">
                {!! Form::submit('添加回复', ['class'=>'btn btn-primary pull-right']) !!}
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
          </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
@stop

@section('javascript')
  <script type="text/javascript">
    $('#AddCommentRepliesModal').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget)
         var commentId = button.data('commentid');
         var modal = $(this)
         modal.find('.modal-body #comment_id').val(commentId)
    });
  </script>
@stop
