<?php

namespace App\Services\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class People extends JsonResource implements Arrayable
{
    use HasGetterSetter;

    public function toArray(?Request $request = null)
    {
        return [
            'name'       => $this->name,
            'gender'     => $this->gender,
            'height'     => floatval($this->height),
            'hair_color' => $this->hair_color,
            'skin_color' => $this->skin_color,
            'mass'       => floatval($this->mass),
        ];
    }

}
