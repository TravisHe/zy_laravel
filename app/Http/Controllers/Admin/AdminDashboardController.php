<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Menu;
use App\Role;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $roles = Role::all();

        return view('admin.index', compact('menus', 'roles'));
    }

}
