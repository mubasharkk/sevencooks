<?php

namespace App\Services\Resources;

trait HasGetterSetter
{
    /**
     * As there is no need for any special getters and setters,
     * we can just use Magic Methods
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $method = substr($name, 0, 3);
        // We can also handle here camelCase to snake_case or vice versa
        $property = lcfirst(substr($name, 3));
        switch ($method) {
            case 'get':
                return $this->resource->{$property} ?? null;
            case 'set':
                if ($this->resource->{$property}) {
                    return $this->resource->{$property} = $arguments[0];
                }
                throw new \Exception("Unable to call class method. Public method [{$name}] not found.");
            default:
                throw new \Exception("Unable to call class method. Public method [{$name}] not found.");
        }
    }
}
