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
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreSeoRequest $request)
    {
        //
    }

    public function show(Seo $seo)
    {
        //
    }

    public function edit(Seo $seo)
    {
        //
    }

    public function update(UpdateSeoRequest $request, Seo $seo)
    {
        //
    }

    public function destroy(Seo $seo)
    {
        //
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
