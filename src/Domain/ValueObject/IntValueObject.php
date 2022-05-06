<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class IntValueObject
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->allowed();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }

    private function allowed()
    {
        if ($this->value >= 0) {
            return true;
        } else {
            throw new \Exception('Coordinate :Only allowed greater than or equal to zero.');
        }
    }
}
