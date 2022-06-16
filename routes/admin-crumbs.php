<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as Trail;


Breadcrumbs::for('admin.index', function (Trail $trail) {
    $trail->push('Главная', route('admin.index'));
});

Breadcrumbs::for('admin.category.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Категории', route('admin.category.index'));
});

Breadcrumbs::for('admin.category.create', function (Trail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('Создать категорию', route('admin.category.create'));
});

Breadcrumbs::for('admin.category.show', function (Trail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('Категорию', route('admin.category.show'));
});



