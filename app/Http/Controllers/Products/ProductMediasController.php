<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\ProductMedia;
use App\ProductDetail;
use App\Menu;
use App\Role;

use App\Http\Requests\AdminProductMediasRequest;
use App\Http\Requests;

class ProductMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_media = ProductMedia::paginate(8);
        $products = ProductDetail::all();
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.products.media.index', compact('products', 'menus', 'product_media', 'roles'));
    }

    /**
     * Display product details depends on menus
     */
    public function products($id)
    {
        $product_media = ProductMedia::where('menu_id', $id)->paginate(8);
        $products = ProductDetail::where('menu_id', $id)->get();
        $menus = Menu::all();
        $roles = Role::all();
        $menu = Menu::where('id', $id)->first();

        return view('admin.products.media.products', compact('products', 'menus', 'product_media', 'menu', 'roles'));
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
    public function store(AdminProductMediasRequest $request)
    {
        $menus = Menu::all();
        $input = $request->all();
        $menu_id = $request->input('menu_id');

        if($file = $request->file('media_1')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_1'] = $name;
        }
        if($file = $request->file('media_2')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_2'] = $name;
        }
        if($file = $request->file('media_3')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_3'] = $name;
        }
        if($file = $request->file('media_4')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_4'] = $name;
        }
        if($file = $request->file('media_5')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_5'] = $name;
        }

        ProductMedia::create($input);

        Session::flash('success', '图片添加成功。');

        return redirect()->route('admin.products_media.products', ['id' => $menu_id]);
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
        $product = ProductMedia::findOrFail($id);
        $product_id = $product->id;
        $menus = Menu::all();
        $roles = Role::all();
        $menu_id = $product->menu->id;
        $products_main = ProductDetail::where('menu_id', $menu_id)->get();

        return view('admin.products.media.edit', compact('product', 'products_main', 'menus', 'product_id', 'roles'));
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
        $product = ProductMedia::findOrFail($id);

        if($file = $request->file('media_1')) {
            if(!is_null($product->media_1)) {
                unlink(public_path() . '/images/products/show_image/' . $product->media_1);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_1'] = $name;
        }

        if($file = $request->file('media_2')) {
            if(!is_null($product->media_2)) {
                unlink(public_path() . '/images/products/show_image/' . $product->media_2);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_2'] = $name;
        }

        if($file = $request->file('media_3')) {
            if(!is_null($product->media_3)) {
                unlink(public_path() . '/images/products/show_image/' . $product->media_3);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_3'] = $name;
        }

        if($file = $request->file('media_4')) {
            if(!is_null($product->media_4)) {
                unlink(public_path() . '/images/products/show_image/' . $product->media_4);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_4'] = $name;
        }

        if($file = $request->file('media_5')) {
            if(!is_null($product->media_5)) {
                unlink(public_path() . '/images/products/show_image/' . $product->media_5);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/products/show_image', $name);
            $input['media_5'] = $name;
        }

        $product->update($input);

        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '图片修改成功。');
          return redirect()->route('admin.product_medias.index');
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
        $product = ProductMedia::findOrFail($id);

        if($product->media_1) {
          unlink(public_path() . '/images/products/show_image/' . $product->media_1);
        }
        if($product->media_2) {
          unlink(public_path() . '/images/products/show_image/' . $product->media_2);
        }
        if($product->media_3) {
          unlink(public_path() . '/images/products/show_image/' . $product->media_3);
        }
        if($product->media_4) {
          unlink(public_path() . '/images/products/show_image/' . $product->media_4);
        }
        if($product->media_5) {
          unlink(public_path() . '/images/products/show_image/' . $product->media_5);
        }

        $product->delete();

        Session::flash('success', '图片删除成功。');
        return redirect()->route('admin.product_medias.index');
    }
}
