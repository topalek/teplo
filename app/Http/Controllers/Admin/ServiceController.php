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
        return view('admin.service.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.service.create', compact('list'));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return redirect()->route('admin.service.show', $service)->with('success', 'Категория сохранена');
    }

    public function show(Service $service)
    {
        return view('admin.service.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('admin.service.show', compact('service'))->with('success', 'Категория обновлена');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.service.index')->with('success', 'Категория удалена');
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
