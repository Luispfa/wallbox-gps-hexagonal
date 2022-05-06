<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\ValueObject\StringValueObject;

final class Direction extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->lengthCharacter();
        $this->allowedCharacter();
    }

    private function allowedCharacter()
    {
        $pattern = "/[NESW]+$/";
        if ($bool = preg_match($pattern, $this->value())) {
            return $bool;
        } else {
            throw new \Exception('Direction :Only allowed N, E, S, W characteres .');
        }
    }

    private function lengthCharacter()
    {
        if (strlen($this->value()) === 1) {
            return true;
        } else {
            throw new \Exception('Direction: Only allowed One character .');
        }
    }
}
