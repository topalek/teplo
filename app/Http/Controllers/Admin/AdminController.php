<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.index');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'tachometer',
            'title' => 'Админ панель',
            'url'   => route('admin.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 1;
    }
}
