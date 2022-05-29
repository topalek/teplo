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
    }

    public function create()
    {
        //
    }

    public function store(StoreParamRequest $request)
    {
        //
    }

    public function show(Param $param)
    {
        //
    }

    public function edit(Param $param)
    {
        //
    }

    public function update(UpdateParamRequest $request, Param $param)
    {
        //
    }

    public function destroy(Param $param)
    {
        //
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
