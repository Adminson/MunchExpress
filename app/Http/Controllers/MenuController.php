<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Rules\RestoCategoryValidate;

class MenuController extends Controller
{

    public function index($id)
    {
        $restoId = $id;
        $restoService = new MenuService;
        $menus = $restoService->getMenuWithCategories($restoId);

        return view('menus.menu-index', compact('menus', 'restoId'));
        // if (!$menus) {
        //     abort(400, 'Wrong resto');
        // }

        // return view('menus.menu-index')
        //     ->with('restoId', $restoId);
    }

    public function addMenuItem(Request $request)
    {
        // dd($request);
        $postData = $this->validate($request, [
            'restoId' => 'required|numeric',
            'price' => 'required|numeric',
            'item' => 'required',
            'category' => 'required',
            'description' => 'required',
            // 'category' => ['required', new RestoCategoryValidate(request('restoId'))],
            'category' => ['required', new RestoCategoryValidate(request('restoId'))],

        ]);


        $conditions = [
            'resto_id' => $postData['restoId'],
            'name' => $postData['category'],
        ];

        $category = Category::where($conditions)
            ->first();

        $menu = Menu::create([
            'name' => $postData['item'],
            'price' => $postData['price'],
            'description' => $postData['description'],
            'resto_id' => $postData['restoId'],
            'category_id' => $category->id,
        ]);

        return response()->json($menu, 201);
    }
}
