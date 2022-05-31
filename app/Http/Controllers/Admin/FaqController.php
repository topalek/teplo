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
        return view('admin.faq.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.faq.create', compact('list'));
    }

    public function store(StoreFaqRequest $request)
    {
        $faq = Faq::create($request->validated());
        return redirect()->route('admin.faq.show', $faq)->with('success', 'Категория сохранена');
    }

    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faq.show', compact('faq'))->with('success', 'Категория обновлена');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'Категория удалена');
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
