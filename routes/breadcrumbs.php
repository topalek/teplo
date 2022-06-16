<?php

use App\Models\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as Trail;


Breadcrumbs::for('admin.index', function (Trail $trail) {
    $trail->push('Главная', route('admin.index'));
});

Breadcrumbs::for('admin.category.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Категории', route('admin.category.index'));
});
Breadcrumbs::for('admin.seo.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Seo', route('admin.seo.index'));
});
Breadcrumbs::for('admin.product.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Товары', route('admin.product.index'));
});
Breadcrumbs::for('admin.param.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Параметры', route('admin.param.index'));
});
Breadcrumbs::for('admin.action.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Акции', route('admin.action.index'));
});
Breadcrumbs::for('admin.order.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Заказы', route('admin.order.index'));
});
Breadcrumbs::for('admin.service.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Услуги', route('admin.service.index'));
});
Breadcrumbs::for('admin.review.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Отзывы', route('admin.review.index'));
});
Breadcrumbs::for('admin.faq.index', function (Trail $trail) {
    $trail->parent('admin.index');
    $trail->push('Faq', route('admin.faq.index'));
});

Breadcrumbs::for('admin.category.create', function (Trail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('Создать категорию', route('admin.category.create'));
});
Breadcrumbs::for('admin.category.edit', function (Trail $trail, Category $category) {
    $trail->parent('admin.category.index');
    $trail->push('Редактировать', route('admin.category.edit', $category));
});
Breadcrumbs::for('admin.category.show', function (Trail $trail, Category $category) {
    $trail->parent('admin.category.index');
    $trail->push('Редактировать', route('admin.category.show', $category));
});
Breadcrumbs::for('admin.product.create', function (Trail $trail) {
    $trail->parent('admin.product.index');
    $trail->push('Создать категорию', route('admin.product.create'));
});
Breadcrumbs::for('admin.product.edit', function (Trail $trail) {
    $trail->parent('admin.product.index');
    $trail->push('Редактировать', route('admin.product.edit'));
});
Breadcrumbs::for('admin.seo.create', function (Trail $trail) {
    $trail->parent('admin.seo.index');
    $trail->push('Создать категорию', route('admin.seo.create'));
});
Breadcrumbs::for('admin.seo.edit', function (Trail $trail) {
    $trail->parent('admin.seo.index');
    $trail->push('Редактировать', route('admin.seo.edit'));
});
Breadcrumbs::for('admin.order.create', function (Trail $trail) {
    $trail->parent('admin.order.index');
    $trail->push('Создать категорию', route('admin.order.create'));
});
Breadcrumbs::for('admin.order.edit', function (Trail $trail) {
    $trail->parent('admin.order.index');
    $trail->push('Редактировать', route('admin.order.edit'));
});
Breadcrumbs::for('admin.page.create', function (Trail $trail) {
    $trail->parent('admin.page.index');
    $trail->push('Создать категорию', route('admin.page.create'));
});
Breadcrumbs::for('admin.page.edit', function (Trail $trail) {
    $trail->parent('admin.page.index');
    $trail->push('Редактировать', route('admin.page.edit'));
});
Breadcrumbs::for('admin.param.create', function (Trail $trail) {
    $trail->parent('admin.param.index');
    $trail->push('Создать категорию', route('admin.param.create'));
});
Breadcrumbs::for('admin.param.edit', function (Trail $trail) {
    $trail->parent('admin.param.index');
    $trail->push('Редактировать', route('admin.param.edit'));
});
Breadcrumbs::for('admin.review.create', function (Trail $trail) {
    $trail->parent('admin.review.index');
    $trail->push('Создать категорию', route('admin.review.create'));
});
Breadcrumbs::for('admin.review.edit', function (Trail $trail) {
    $trail->parent('admin.review.index');
    $trail->push('Редактировать', route('admin.review.edit'));
});
Breadcrumbs::for('admin.service.create', function (Trail $trail) {
    $trail->parent('admin.service.index');
    $trail->push('Создать категорию', route('admin.service.create'));
});
Breadcrumbs::for('admin.service.edit', function (Trail $trail) {
    $trail->parent('admin.service.index');
    $trail->push('Редактировать', route('admin.service.edit'));
});
Breadcrumbs::for('admin.faq.create', function (Trail $trail) {
    $trail->parent('admin.faq.index');
    $trail->push('Создать категорию', route('admin.faq.create'));
});
Breadcrumbs::for('admin.faq.edit', function (Trail $trail) {
    $trail->parent('admin.faq.index');
    $trail->push('Редактировать', route('admin.faq.edit'));
});
Breadcrumbs::for('admin.action.create', function (Trail $trail) {
    $trail->parent('admin.action.index');
    $trail->push('Создать категорию', route('admin.action.create'));
});
Breadcrumbs::for('admin.action.edit', function (Trail $trail) {
    $trail->parent('admin.action.index');
    $trail->push('Редактировать', route('admin.action.edit'));
});



