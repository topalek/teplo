<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        $products = Product::with('category')->paginate();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck(['title', 'id'])->all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return redirect()->route('admin.product.show', $product)->with('success', 'Товар сохранен');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('admin.product.show', compact('product'))->with('success', 'Товар обновлен');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Товар удален');
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
