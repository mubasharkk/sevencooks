<?php

namespace App\Services\Resources;

use Illuminate\Contracts\Support\Arrayable;

interface Cargo extends Arrayable
{
    public function weight(): int;

    public function type(): string;
}
