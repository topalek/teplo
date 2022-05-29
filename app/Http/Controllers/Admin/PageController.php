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
        //
    }

    public function create()
    {
        //
    }

    public function store(StorePageRequest $request)
    {
        //
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        //
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    public function destroy(Page $page)
    {
        //
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
