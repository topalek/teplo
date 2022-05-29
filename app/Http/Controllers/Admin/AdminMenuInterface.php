<?php
/**
 * Created by topalek
 * Date: 28.05.2022
 * Time: 15:40
 */

namespace App\Http\Controllers\Admin;

interface AdminMenuInterface
{
    public static function getMenuItem(): array;

    public static function getMenuPosition(): int;
}
