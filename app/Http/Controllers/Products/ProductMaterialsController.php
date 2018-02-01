<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\ProductMaterial;
use App\Menu;
use App\Role;

use App\Http\Requests\AdminProductStylesRequest;
use App\Http\Requests;

class ProductMaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = ProductMaterial::paginate(8);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.styles.materials', compact('materials', 'menus', 'roles'));
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
    public function store(AdminProductStylesRequest $request)
    {
        ProductMaterial::create($request->all());
        Session::flash('success', '材料创建成功。');
        return redirect()->route('admin.materials.index');
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
        $material = ProductMaterial::findOrFail($id);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.styles.material_edit', compact('material', 'menus', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminProductStylesRequest $request, $id)
    {
        $material = ProductMaterial::findOrFail($id);
        $material->update($request->all());
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '材料修改成功。');
          return redirect()->route('admin.materials.index');
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
        ProductMaterial::findOrFail($id)->delete();
        Session::flash('danger', '材料删除成功。');
        return redirect()->route('admin.materials.index');
    }
}
