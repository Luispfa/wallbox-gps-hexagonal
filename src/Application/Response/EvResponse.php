<?php

declare(strict_types=1);

namespace App\Application\Response;

use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;

final class EvResponse
{
    private $coordinateX;
    private $coordinateY;
    private $direction;
    
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
