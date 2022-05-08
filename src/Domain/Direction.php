<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\ValueObject\StringValueObject;

use function PHPSTORM_META\elementType;

final class Direction extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->lengthCharacter();
        $this->allowedCharacter();
    }

    private function allowedCharacter(): void
    {
        $expresion = ElectricVehicle::NORTH . ElectricVehicle::EAST . ElectricVehicle::SOUTH. ElectricVehicle::WEST;
        $pattern = "/[" . $expresion . "]+$/";
        if (!preg_match($pattern, $this->value())) {
            throw new \Exception('Direction :Only allowed N, E, S, W characteres .');
        }
    }

    private function lengthCharacter(): void
    {
        if (!(strlen($this->value()) === 1)) {
            throw new \Exception('Direction: Only allowed One character .');
        }
    }
}
