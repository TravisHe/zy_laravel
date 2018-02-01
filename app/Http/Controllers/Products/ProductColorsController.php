<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\ProductColor;
use App\Menu;
use App\Role;

class ProductColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = ProductColor::paginate(8);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.styles.colors', compact('colors', 'menus', 'roles'));
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
        ProductColor::create($request->all());
        Session::flash('success', '颜色创建成功。');
        return redirect()->route('admin.colors.index');
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
        $color = ProductColor::findOrFail($id);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.styles.color_edit', compact('color', 'menus', 'roles'));
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
        $color = ProductColor::findOrFail($id);
        $color->update($request->all());
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '颜色修改成功。');
          return redirect()->route('admin.colors.index');
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
        ProductColor::findOrFail($id)->delete();
        Session::flash('danger', '颜色删除成功。');
        return redirect()->route('admin.colors.index');
    }
}
