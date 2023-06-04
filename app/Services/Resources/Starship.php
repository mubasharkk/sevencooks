<?php

namespace App\Services\Resources;

use Illuminate\Contracts\Support\Arrayable;
use  Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class Starship extends JsonResource implements Arrayable
{
    use HasGetterSetter;

    private ?Collection $cargo = null;

    public function toArray(?Request $request = null)
    {
        return [
            'name'              => $this->name,
            'model'             => $this->model,
            'class'             => $this->starship_class,
            'capacity'          => [
                'crew'       => $this->crew,
                'passengers' => $this->passengers,
                'cargo'      => intval($this->cargo_capacity),
            ],
            'cargo'             => $this->cargo,
            'pilots'            => $this->pilots,
            'manufacturer'      => $this->manufacturer,
            'hyperdrive_rating' => floatval($this->hyperdrive_rating),
            'speed'             => intval($this->max_atmosphering_speed),
        ];
    }

    // we can also do a restriction check with cargo limit here
    public function loadCargo(Cargo $cargo)
    {
        $this->cargo->add($cargo);
    }

    /**
     * Made it simple, didn't have time to write a more suitable and complex definition
     */
    public function offloadCargo($index)
    {
        $this->cargo->forget($index);
    }
}
