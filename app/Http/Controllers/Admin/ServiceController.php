<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends BaseAdminController implements AdminMenuInterface
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreServiceRequest $request)
    {
        //
    }

    public function show(Service $service)
    {
        //
    }

    public function edit(Service $service)
    {
        //
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    public function destroy(Service $service)
    {
        //
    }

    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'handshake-o',
            'title' => 'Услуги',
            'url'   => route('admin.service.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 5;
    }
}
