<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreProductRequest $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'shopping-basket',
            'title' => 'Товары',
            'url'   => route('admin.product.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 1;
    }
}
