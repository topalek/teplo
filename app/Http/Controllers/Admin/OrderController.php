<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;

class OrderController extends BaseAdminController implements AdminMenuInterface
{
    public static function getMenuItem(): array
    {
        return [
            'icon'  => 'shopping-cart',
            'title' => 'Заказы',
            'url'   => route('admin.order.index'),
        ];
    }

    public static function getMenuPosition(): int
    {
        return 1;
    }

    public function index()
    {
        return view('admin.order.index');
    }

    public function create()
    {
        $list = [];
        return view('admin.order.create', compact('list'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        return redirect()->route('admin.order.show', $order)->with('success', 'Категория сохранена');
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('admin.order.show', compact('order'))->with('success', 'Категория обновлена');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Категория удалена');
    }
}
