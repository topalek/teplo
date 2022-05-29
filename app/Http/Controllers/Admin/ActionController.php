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
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreActionRequest $request)
    {
        //
    }

    public function show(Action $action)
    {
        //
    }

    public function edit(Action $action)
    {
        //
    }

    public function update(UpdateActionRequest $request, Action $action)
    {
        //
    }

    public function destroy(Action $action)
    {
        //
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
