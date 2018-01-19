<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\User;
use App\Menu;
use App\CommentReply;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment_replies = CommentReply::paginate(8);;
        $menus = Menu::all();
        return view('admin/comments/replies', compact('comment_replies', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = [
            'comment_id' => $request->comment_id,
            'author'     => $user->id,
            'body'       => $request->body,
            'is_active'  => $request->is_active,
        ];

        CommentReply::create($data);

        Session::flash('success', '评论回复添加成功。');

        return redirect()->route('admin.comments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menu::all();
        $comment_reply = CommentReply::findOrFail($id);

        return view('admin/comments/reply_edit', compact('comment_reply', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $comment_reply = CommentReply::findOrFail($id);
        $comment_reply->update($input);

        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '评论回复修改成功。');
          return redirect()->route('admin.comment_replies.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment_reply = CommentReply::findOrFail($id);
        $comment_reply->delete();

        Session::flash('success', '评论回复删除成功。');
        return redirect()->route('admin.comment_replies.index');
    }
}
