<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;

class OrderController extends BaseAdminController implements AdminMenuInterface
{
    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'shopping-cart',
            'title' => 'Заказы',
            'url'   => route('admin.order.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 1;
    }

    public function index()
    {
        return view('admin.order.index');
    }
}
