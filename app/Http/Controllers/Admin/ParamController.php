<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreParamRequest;
use App\Http\Requests\UpdateParamRequest;
use App\Models\Param;

class ParamController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        return view('admin.param.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.param.create', compact('list'));
    }

    public function store(StoreParamRequest $request)
    {
        $param = Param::create($request->validated());
        return redirect()->route('admin.param.show', $param)->with('success', 'Категория сохранена');
    }

    public function show(Param $param)
    {
        return view('admin.param.show', compact('param'));
    }

    public function edit(Param $param)
    {
        return view('admin.param.edit', compact('param'));
    }

    public function update(UpdateParamRequest $request, Param $param)
    {
        $param->update($request->validated());

        return redirect()->route('admin.param.show', compact('param'))->with('success', 'Категория обновлена');
    }

    public function destroy(Param $param)
    {
        $param->delete();
        return redirect()->route('admin.param.index')->with('success', 'Категория удалена');
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'sliders',
            'title' => 'Параметры',
            'url'   => route('admin.param.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 6;
    }
}
