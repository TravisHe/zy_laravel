<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Role;
use App\Menu;
use App\JobTitle;

use App\Http\Requests\AdminManagersRequest;
use App\Http\Requests;


class AdminManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::paginate(8);
        $job_titles = JobTitle::all();
        $roles = Role::all();
        $menus = Menu::all();

        return view('admin.admins.index', compact('users', 'roles', 'menus', 'job_titles'));
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
    public function store(AdminManagersRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('avatar')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/avatars', $name);
            $input['avatar'] = $name;
        }
        $input['password'] = bcrypt($request->password);

        Admin::create($input);

        Session::flash('success', '管理员权限创建成功。');

        return redirect()->route('admin.admins.index');
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
        $user = Admin::findOrFail($id);
        $job_titles = JobTitle::all();
        $roles = Role::all();
        $menus = Menu::all();

        return view('admin.admins.edit', compact('user', 'roles', 'menus', 'job_titles'));
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
        $user = Admin::findOrFail($id);

        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if($file = $request->file('avatar')){
            if(!is_null($user->avatar)) {
                unlink(public_path() . '/images/avatars/' . $user->avatar);
            }
            $name = time().$file->getClientOriginalName();
            $file->move('images/avatars', $name);
            $input['avatar'] = $name;
        }

        $user->update($input);

        Session::flash('success', '管理员权限更新成功。');

        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Admin::findOrFail($id);

        if($user->avatar) {
            unlink(public_path() . '/images/avatars/' . $user->avatar);
        }

        $user->delete();

        Session::flash('danger', '管理员删除成功。');

        return redirect()->route('admin.admins.index');
    }
}
