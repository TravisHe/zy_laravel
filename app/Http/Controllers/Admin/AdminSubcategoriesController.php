<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Menu;
use App\Maincategory;
use App\Subcategory;
use App\Role;

use App\Http\Requests\AdminSubcategoriesRequest;
use App\Http\Requests;

class AdminSubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $roles = Role::all();
        $maincategories = Maincategory::all();
        $subcategories = Subcategory::paginate(8);

        return view('admin.categories.subcategories.index', compact('maincategories', 'menus', 'subcategories', 'roles'));
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
    public function store(AdminSubcategoriesRequest $request)
    {
        Subcategory::create($request->all());
        Session::flash('success', '主分类创建成功。');
        return redirect()->route('admin.subcategories.index');
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
        $maincategories = Maincategory::all();
        $subcategory = Subcategory::findOrFail($id);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.categories.subcategories.edit', compact('subcategory', 'maincategories', 'menus', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminSubcategoriesRequest $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '二级分类修改成功。');
          return redirect()->route('admin.subcategories.index');
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
        Subcategory::findOrFail($id)->delete();
        Session::flash('success', '主分类删除成功。');
        return redirect()->route('admin.subcategories.index');
    }
}
