<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function index()
    {
        return view('admin.index');
    }
}
