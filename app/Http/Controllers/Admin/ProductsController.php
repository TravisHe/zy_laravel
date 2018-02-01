<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Product;
use App\Manufactor;
use App\Menu;
use App\Role;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(8);
        $manufactors = Manufactor::all();
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.main.index', compact('products', 'manufactors', 'menus', 'roles'));
    }

    /**
     * Display products under specific menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function products($id)
    {
        $products = Product::where('menu_id', $id)->paginate(8);
        $manufactors = Manufactor::all();
        $menus = Menu::all();
        $roles = Role::all();
        $menu = Menu::where('id', $id)->first();

        return view('admin.products.main.products', compact('products', 'manufactors', 'menus', 'menu', 'roles'));
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
        $manufactors = Manufactor::all();
        $menus = Menu::all();
        $input = $request->all();
        $menu_id = $request->input('menu_id');

        Product::create($input);

        Session::flash('success', '商品添加成功。');

        return redirect()->route('admin.products_main.index', ['id' => $menu_id]);
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
        $product = Product::findOrFail($id);
        $manufactors = Manufactor::all();
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.main.edit', compact('product', 'manufactors', 'menus'));
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
        $menu_id = $request->input('menu_id');
        $product = Product::findOrFail($id);
        $product->update($input);

        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '商品修改成功。');
          return redirect()->route('admin.products_main.index', ['id' => $menu_id]);
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
        $product = Product::findOrFail($id);
        $product->delete();

        Session::flash('success', '商品删除成功。');
        return redirect()->route('admin.products_main.index', ['id' => 1]);
    }
}
