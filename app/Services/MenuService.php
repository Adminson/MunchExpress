<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getMenuWithCategories($restoIds)
    {
        $category = Menu::where('resto_id', $restoIds)
            ->get()
            ->groupBy('category.name');

        return $category;
    }
}
