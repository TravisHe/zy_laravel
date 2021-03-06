<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Menu;
use App\Role;
use App\Maincategory;

use App\Http\Requests\AdminMaincategoriesRequest;
use App\Http\Requests;

class AdminMaincategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maincategories = Maincategory::paginate(8);
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.categories.maincategories.index', compact('maincategories', 'menus', 'roles'));
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
    public function store(AdminMaincategoriesRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('icon')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/icons', $name);
            $input['icon'] = $name;
        }

        Maincategory::create($input);

        Session::flash('success', '一级分类创建成功。');

        return redirect()->route('admin.maincategories.index');
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
        $menus = Menu::all();
        $roles = Role::all();
        $maincategory = Maincategory::findOrFail($id);

        return view('admin.categories.maincategories.edit', compact('maincategory', 'menus', 'roles'));
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
        $maincategory = Maincategory::findOrFail($id);
        if($file = $request->file('icon')) {
            if(!is_null($maincategory->icon)) {
                unlink(public_path() . '/images/icons/' . $maincategory->icon);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('images/icons', $name);
            $input['icon'] = $name;
        }
        $maincategory->update($input);
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '一级分类修改成功。');
          return redirect()->route('admin.maincategories.index');
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
        $maincategory = Maincategory::findOrFail($id);

        unlink(public_path() . '/images/icons/' . $maincategory->icon);

        $maincategory->delete();

        Session::flash('success', '一级分类删除成功。');

        return redirect()->route('admin.maincategories.index');
    }
}
