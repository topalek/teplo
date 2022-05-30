<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends BaseAdminController implements AdminMenuInterface
{

    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.category.create', compact('list'));
    }

    public function store(StoreCategoryRequest $request)
    {
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'calendar',
            'title' => 'Категори',
            'url'   => route('admin.category.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 1;
    }
}
