<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreActionRequest;
use App\Http\Requests\UpdateActionRequest;
use App\Models\Action;

class ActionController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.action.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.action.create', compact('list'));
    }

    public function store(StoreActionRequest $request)
    {
        $action = Action::create($request->validated());
        return redirect()->route('admin.action.show', $action)->with('success', 'Категория сохранена');
    }

    public function show(Action $action)
    {
        return view('admin.action.show', compact('action'));
    }

    public function edit(Action $action)
    {
        return view('admin.action.edit', compact('action'));
    }

    public function update(UpdateActionRequest $request, Action $action)
    {
        $action->update($request->validated());

        return redirect()->route('admin.action.show', compact('action'))->with('success', 'Категория обновлена');
    }

    public function destroy(Action $action)
    {
        $action->delete();
        return redirect()->route('admin.action.index')->with('success', 'Категория удалена');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'percent',
            'title' => 'Акции',
            'url'   => route('admin.action.index'),
        ];
    }


    public static function getMenuPosition(): int
    {
        return 2;
    }
}
