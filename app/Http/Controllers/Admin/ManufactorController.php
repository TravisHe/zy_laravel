<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\City;
use App\Country;
use App\Manufactor;
use App\Menu;

use App\Http\Requests\AdminManufactorsRequest;
use App\Http\Requests;

class ManufactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufactors = Manufactor::paginate(8);
        $countries = Country::all();
        $cities = City::all();
        $menus = Menu::all();

        return view('admin.general.manufactor', compact('manufactors', 'countries', 'cities', 'menus'));
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
    public function store(AdminManufactorsRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('logo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/manufactors/logo', $name);
            $input['logo'] = $name;
        }

        Manufactor::create($input);

        Session::flash('success', '制造商信息添加成功。');

        return redirect('/zen/manufactors');
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
        $countries = Country::all();
        $cities = City::all();
        $manufactor = Manufactor::findOrFail($id);
        $menus = Menu::all();

        return view('admin.general.manufactor_edit', compact('manufactor', 'cities', 'countries', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminManufactorsRequest $request, $id)
    {
        $input = $request->all();
        $manufactor = Manufactor::findOrFail($id);
        if($file = $request->file('logo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images/manufactors/logo', $name);
            $input['logo'] = $name;
        }
        $manufactor->update($input);
        $errors = Session::get('errors');
        if(count($errors)>0){
          return redirect()->back();
        } else {
          Session::flash('info', '制造商修改成功。');
          return redirect('/zen/manufactors');
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
        $manufactor = Manufactor::findOrFail($id);

        unlink(public_path() . '/images/manufactors/logo/' . $manufactor->logo);

        $manufactor->delete();

        Session::flash('success', '制造商删除成功。');

        return redirect('/zen/manufactors');
    }
}
