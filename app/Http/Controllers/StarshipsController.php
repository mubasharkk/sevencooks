<?php

namespace App\Http\Controllers;

use App\Services\StarWarsService;
use Illuminate\Http\Request;

class StarshipsController extends Controller
{
    private StarWarsService $service;

    public function __construct(StarWarsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $request->validate([
            'page'   => 'integer',
            'format' => 'in:json,html',
            'count' => 'integer|min:5|max:36'
        ]);

        $starShips = $this->service->getStarShips();

//        if ($request->get('format') == 'html') {
//            return view();
//        }

        return $starShips->sortByDesc(function ($ship, $item){
            return $ship->getSpeed();
        });
    }


    public function show(string $id)
    {
    }
}
