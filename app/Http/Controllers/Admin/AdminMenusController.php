<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Menu;
use App\Role;

use App\Http\Requests\AdminMenusRequest;
use App\Http\Requests;

class AdminMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(8);
        $roles = Role::all();

        return view('admin.categories.menus.index', compact('menus', 'roles'));
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
    public function store(AdminMenusRequest $request)
    {
        Menu::create($request->all());
        Session::flash('success', '主分类创建成功。');
        return redirect()->route('admin.menus.index');
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
        $menu = Menu::findOrFail($id);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.categories.menus.edit', compact('menu', 'menus', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminMenusRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($request->all());
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '主分类修改成功。');
          return redirect()->route('admin.menus.index');
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
        Menu::findOrFail($id)->delete();
        Session::flash('danger', '主分类删除成功。');
        return redirect()->route('admin.menus.index');
    }
}
