<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Product;
use App\ProductDetail;
use App\Menu;
use App\ProductColor;
use App\ProductSize;
use App\ProductMaterial;

use App\Http\Requests\AdminProductDetailsRequest;
use App\Http\Requests;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductDetail::paginate(8);
        $products_main = Product::all();
        $product_colors = ProductColor::all();
        $product_sizes = ProductSize::all();
        $product_materials = ProductMaterial::all();
        $menus = Menu::all();

        return view('admin.products.detail.index', compact('products', 'products_main', 'product_colors',
                    'product_sizes', 'product_materials','menus'));
    }

    /**
     * Display product details depends on menus
     */
    public function products($id)
    {
        $products = ProductDetail::where('menu_id', $id)->paginate(8);
        $products_main = Product::where('menu_id', $id)->get();
        $product_colors = ProductColor::all();
        $product_sizes = ProductSize::where('menu_id', $id)->get();
        $product_materials = ProductMaterial::where('menu_id', $id)->get();
        $menus = Menu::all();
        $menu = Menu::where('id', $id)->first();

        return view('admin.products.detail.products', compact('products', 'products_main', 'product_colors',
                    'product_sizes', 'product_materials','menus', 'menu'));
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
    public function store(AdminProductDetailsRequest $request)
    {
        $menus = Menu::all();
        $input = $request->all();
        $menu_id = $request->input('menu_id');
        $name = $request->input('name');

        if(is_null($name)) {
            $products = Product::where('id', $request->input('product_id'))->first();
            $name = $products->name;
            $input['name'] = $name;
        }

        ProductDetail::create($input);

        Session::flash('success', '商品添加成功。');

        return redirect()->route('admin.products_detail.products', ['id' => $menu_id]);
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
        $product = ProductDetail::findOrFail($id);
        $price = $product->price;
        $menu_id = $product->menu->id;
        $color = $product->color;
        $size = $product->size;
        $material = $product->material;
        $products_main = Product::where('menu_id', $menu_id)->get();
        $product_colors = ProductColor::all();
        $product_sizes = ProductSize::where('menu_id', $menu_id)->get();
        $product_materials = ProductMaterial::where('menu_id', $menu_id)->get();
        $menus = Menu::all();

        return view('admin.products.detail.edit', compact('product', 'products_main', 'product_colors',
                    'product_sizes', 'product_materials','menus', 'color', 'size', 'material', 'price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminProductDetailsRequest $request, $id)
    {
        $input = $request->all();
        $product = ProductDetail::findOrFail($id);
        $name = $request->input('name');

        if(is_null($name)) {
            $products = Product::where('id', $request->input('product_id'))->first();
            $name = $products->name;
            $input['name'] = $name;
        }
        
        $product->update($input);

        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '商品修改成功。');
          return redirect()->route('admin.products_detail.index');
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
        $product = ProductDetail::findOrFail($id);
        $product->delete();

        Session::flash('success', '商品删除成功。');
        return redirect()->route('admin.products_detail.index');
    }
}
