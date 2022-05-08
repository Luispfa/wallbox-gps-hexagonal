<?php

declare(strict_types = 1);

namespace App\Domain;

use App\Domain\ValueObject\IntValueObject;

final class CoordinateY extends IntValueObject
{
    public function __construct(int $value, ?int $maxValue = null)
    {
        parent::__construct($value);
        if ($maxValue) {
            $this->allowed($maxValue);
        }
    }

    private function allowed($maxValue): void
    {
        if ($this->value < 0 || $this->value > $maxValue) {
            throw new \Exception('Coordinate Y: Only allowed values between 0 and ' . $maxValue . '.');
        }
    }
}
