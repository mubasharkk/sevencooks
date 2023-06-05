<?php

namespace App\Services;

use App\Services\Resources\People;
use App\Services\Resources\Starship;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class StarWarsService
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function getData(string $uri)
    {
        $response = $this->client->get($uri);
        return \json_decode($response->getBody()->getContents());
    }

    public function getStarShips(): Collection
    {
        // This should be done via config
        // This API is fetch only the first page, it can be tuned to fetch the complete set of data for all Starships
        $data = $this->getData('https://swapi.dev/api/starships');

        $ships = array_map(function ($ship) {
            // Fetching pilots' data can be made condition via config or params
            // or can be made condition via request params
            $ship->pilots = $this->getPilots($ship->pilots);
            return new Starship($ship);
        }, (array) $data->results);

        return collect($ships);
    }

    private function getPilots(array $pilotsUri)
    {
        $pilotsData = collect();
        foreach ($pilotsUri as $uri) {
            $pilotsData->push(
                new People(
                    $this->getData($uri)
                )
            );
        }

        return People::collection($pilotsData);
    }
}
