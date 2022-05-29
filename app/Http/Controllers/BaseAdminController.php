<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminMenuInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use ReflectionClass;

class BaseAdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $controllers = [];
        $actions = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            $actions[] = $action;
            if (array_key_exists('controller', $action)) {
                $controller = Arr::first(explode('@', $action['controller']));
                // to separate the class name from the method
                $controllers[] = $controller;
            }
        }
//        dd($actions);
        $controllers = array_unique($controllers);
        $menu = [];
        foreach ($controllers as $controller) {
            if (class_exists($controller)) {
                $ref = new ReflectionClass($controller);
                $class = $ref->newInstanceWithoutConstructor();
                if ($class instanceof AdminMenuInterface) {
                    $menu[$class::getMenuPosition()][] = $class::getMenuItem();
                }
            }
        }
        View::share('adminMenu', $menu);
    }
}
