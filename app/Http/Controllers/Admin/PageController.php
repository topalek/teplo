<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;

class PageController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.page.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.page.create', compact('list'));
    }

    public function store(StorePageRequest $request)
    {
        $page = Page::create($request->validated());
        return redirect()->route('admin.page.show', $page)->with('success', 'Категория сохранена');
    }

    public function show(Page $page)
    {
        return view('admin.page.show', compact('page'));
    }

    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());

        return redirect()->route('admin.page.show', compact('page'))->with('success', 'Категория обновлена');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index')->with('success', 'Категория удалена');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'book',
            'title' => 'Страницы',
            'url'   => route('admin.page.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 2;
    }
}
