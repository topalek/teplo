<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;

class FaqController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreFaqRequest $request)
    {
        //
    }

    public function show(Faq $faq)
    {
        //
    }

    public function edit(Faq $faq)
    {
        //
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        //
    }

    public function destroy(Faq $faq)
    {
        //
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'edit',
            'title' => 'FAQ',
            'url'   => route('admin.faq.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 10;
    }
}
