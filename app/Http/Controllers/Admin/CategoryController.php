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
        $list = Category::pluck(['title', 'id'])->all();

        return view('admin.category.create', compact('list'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::make($request->validated());
        $category->save();
        return redirect()->route('admin.category.show', $category)->with('success', 'Категория сохранена');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $list = Category::pluck(['title', 'id'])->all();
        return view('admin.category.edit', compact('category', 'list'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.category.show', compact('category'))->with('success', 'Категория обновлена');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Категория удалена');
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
