<?php

namespace App\Http\Controllers;

use App\Services\Resources\Starship;
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
            'format' => 'string|in:json,html',
            'count'  => 'integer|min:5|max:36'
        ]);

        $starShips = $this->service->getStarShips();

        // sort by speed DESC
        $sorted = $starShips->sortByDesc(function (Starship $ship, $item) {
            return intval($ship->getMax_atmosphering_speed());
        });

        $fastest = $sorted->first();

        $sorted->map(function (Starship $ship) use ($fastest){
            $ship->compareSpeed($fastest);
        });

        return $sorted->values()->all();
    }


    public function show(string $id)
    {
    }
}
