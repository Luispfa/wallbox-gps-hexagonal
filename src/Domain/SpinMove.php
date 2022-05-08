<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\ValueObject\StringValueObject;

final class SpinMove extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->allowedCharacter();
    }

    private function allowedCharacter(): void
    {
        $expresion = ElectricVehicle::RIGHT . ElectricVehicle::LEFT . ElectricVehicle::MOVE;
        $pattern = "/[" . $expresion . "]+$/";
        if (!preg_match($pattern, $this->value())) {
            throw new \Exception('spin Move : Only allowed R, L, M characteres.');
        }
    }
}
