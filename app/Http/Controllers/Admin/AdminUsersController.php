<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\UserDetail;

use App\Http\Requests\AdminUsersRequest;
use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(8);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
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
    public function store(AdminUsersRequest $request)
    {
        $roles = Role::all();

        $input = $request->all();

        $input['password'] = bcrypt($request->password);

        User::create($input);

        Session::flash('success', '用户创建成功。');

        return redirect('/zen/users');
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
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);

        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else {

            $input = $request->all();

            $input['password'] = bcrypt($request->password);

        }

        if($file = $request->file('avatar')){

            $name = time().$file->getClientOriginalName();

            $file->move('images/avatars', $name);

            UserDetail::create(['avatar'=>$name, 'user_id'=>$user->id]);

        }

        $user->update($input);

        Session::flash('updated_user', 'The user has been updated.');

        return redirect('/zen/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user_details = $user -> userDetail;

        if($user_details === null) {
            $user->delete();
        } else {
            $user->delete();
            $user_details->delete();
            unlink(public_path() . '/images/avatars/' . $user->userDetail->avatar);
        }

        Session::flash('deleted_user', 'The user has been deleted.');

        return redirect('/zen/users');
    }

    public function vip()
    {
        $vips = User::where('role_id', 3)->paginate(8);
        $roles = Role::all();
        return view('admin.users.vip', compact('vips', 'roles'));
    }

    public function admin()
    {
        $admins = User::where('role_id', 1)->paginate(8);
        $roles = Role::all();
        return view('admin.users.admin', compact('admins', 'roles'));
    }
}
