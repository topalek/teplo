<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class AdminMenuBuilder
{

    public array $menu;

    public function __construct(array $menu)
    {
        $this->menu = $menu;
    }

    public static function buildItems(array $menu)
    {
        $content = [];
        foreach ($menu as $items) {
            foreach ($items as $item) {
                $content[] = self::buildItem($item);
            }
        }
        $content = implode("\n", $content);
        return Html::tag('ul', $content, ['class' => 'nav nav-pills nav-sidebar flex-column']);
    }

    public static function buildItem(array $item, array $options = []): string
    {
        $linkOptions = Arr::pull($item, 'linkOptions', []);
        $icon = Arr::pull($item, 'icon', 'circle-o');
        $icon = Html::tag('i', '', ['class' => 'nav-icon fa fa-' . $icon]);
        $title = Arr::pull($item, 'title', '');
        $title = Html::tag('p', $title);
        $url = Arr::pull($item, 'url', '');
        $active = (url()->current() == $url) ? ' active' : '';
        $a = Html::a($icon . $title, $url, array_merge($linkOptions, ['class' => 'nav-link' . $active]));
        $li = Html::tag('li', $a, array_merge($options, ['class' => 'nav-item']));
        return $li;
    }
}
