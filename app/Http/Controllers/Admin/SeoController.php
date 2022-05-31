<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreSeoRequest;
use App\Http\Requests\UpdateSeoRequest;
use App\Models\Seo;

class SeoController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.seo.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.seo.create', compact('list'));
    }

    public function store(StoreSeoRequest $request)
    {
        $seo = Seo::create($request->validated());
        return redirect()->route('admin.seo.show', $seo)->with('success', 'Категория сохранена');
    }

    public function show(Seo $seo)
    {
        return view('admin.seo.show', compact('seo'));
    }

    public function edit(Seo $seo)
    {
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        $seo->update($request->validated());

        return redirect()->route('admin.seo.show', compact('seo'))->with('success', 'Категория обновлена');
    }

    public function destroy(Seo $seo)
    {
        $seo->delete();
        return redirect()->route('admin.seo.index')->with('success', 'Категория удалена');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'globe',
            'title' => 'Seo',
            'url'   => route('admin.seo.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 5;
    }
}
