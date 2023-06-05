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

    private float $speedComparison = 100;

    public function toArray(?Request $request = null)
    {
        return [
            'name'              => $this->name,
            'model'             => $this->model,
            'speed'             => intval($this->max_atmosphering_speed),
            'speed_comparison'  => $this->speedComparison,
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

    public function compareSpeed(self $fastest)
    {
        $this->speedComparison = round(intval($this->max_atmosphering_speed) / intval($fastest->getMax_atmosphering_speed()), 2) * 100;
    }
}
