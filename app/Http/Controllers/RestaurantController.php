<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestoService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RestaurantController extends Controller
{

    public function index(RestoService $restoService)
    {
        $restos = $restoService->userRestoAndTables();

        return view('restos.resto-index', compact('restos'));
        // return view('restos.resto-index')->with('restos', $restos);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, [
            'name' => 'required|min:3',
            'location' => 'required|min:3',
            'tables' => 'required|integer',
        ]);

        $resto = Auth::user()
            ->restaurants()
            ->create($postData);

        return response()->json($resto, 201);
    }
}
