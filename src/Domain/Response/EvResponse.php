<?php

declare(strict_types=1);

namespace App\Domain\Response;

use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;

final class EvResponse
{
    private  $coordinateX, $coordinateY, $direction;

    public function __construct(
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction
    ) {

        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->direction = $direction;
    }

    public function __invoke(): string
    {
        return "{$this->coordinateX->value()} {$this->coordinateY->value()} {$this->direction->value()}";
    }
}
