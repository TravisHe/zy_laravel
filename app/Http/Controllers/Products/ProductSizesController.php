<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\ProductSize;
use App\Menu;

use App\Http\Requests\AdminProductStylesRequest;
use App\Http\Requests;

class ProductSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = ProductSize::paginate(8);
        $menus = Menu::all();

        return view('admin.products.styles.sizes', compact('sizes', 'menus'));
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
        ProductSize::create($request->all());
        Session::flash('success', '尺寸创建成功。');
        return redirect('zen/products/sizes');
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
        $size = ProductSize::findOrFail($id);
        $menus = Menu::all();

        return view('admin.products.styles.size_edit', compact('size', 'menus'));
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
        $size = ProductSize::findOrFail($id);
        $size->update($request->all());
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '尺寸修改成功。');
          return redirect('/zen/products/sizes');
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
        ProductSize::findOrFail($id)->delete();
        Session::flash('danger', '尺寸删除成功。');
        return redirect('/zen/products/sizes');
    }
}
