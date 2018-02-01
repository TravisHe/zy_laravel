<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\UserDetail;
use App\Menu;

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
        $menus = Menu::all();

        return view('admin.users.index', compact('users', 'roles', 'menus'));
    }

    /**
     * Display users details depends on defferent roles
     */
    public function roles($id)
    {
        $users = User::where('role_id', $id)->paginate(8);
        $menus = Menu::all();
        $roles = Role::all();
        $role = Role::where('id', $id)->first();

        return view('admin.users.roles', compact('users', 'menus', 'roles', 'role'));
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
        $input = $request->all();

        $input['password'] = bcrypt($request->password);

        if($file = $request->file('avatar')){
            $name = time().$file->getClientOriginalName();
            $file->move('images/avatars', $name);
            $user_detail = new UserDetail;
            $user_detail->user_id = $user->id;
            $user_detail->avatar = $name;
            $user_detail->save();
        }

        User::create($input);

        Session::flash('success', '用户创建成功。');

        return redirect()->route('admin.users.index');
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
        $menus = Menu::all();

        return view('admin.users.edit', compact('user', 'roles', 'menus'));
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
            if(isset($user->userDetail->avatar) && !is_null($user->userDetail->avatar)) {
                unlink(public_path() . '/images/avatars/' . $user->userDetail->avatar);
                $name = time().$file->getClientOriginalName();
                $file->move('images/avatars', $name);
                UserDetail::where('user_id', $user->id)->update(['avatar'=>$name]);
            } else if(isset($user->userDetail->avatar) && is_null($user->userDetail->avatar)) {
                $name = time().$file->getClientOriginalName();
                $file->move('images/avatars', $name);
                UserDetail::where('user_id', $user->id)->update(['avatar'=>$name]);
            } else {
                $name = time().$file->getClientOriginalName();
                $file->move('images/avatars', $name);
                $user_detail = new UserDetail;
                $user_detail->user_id = $user->id;
                $user_detail->avatar = $name;
                $user_detail->save();
            }
        }

        $user->update($input);

        Session::flash('success', 'The user has been updated.');

        return redirect()->route('admin.users.index');
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

        Session::flash('danger', 'The user has been deleted.');

        return redirect()->route('admin.users.index');
    }

}
