<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\Bus\Query\Query;

final class AutoPilotQuery implements Query
{
    private  $upperRightX, $upperRightY, $coordinateX, $coordinateY, $direction, $spinMove;

    public function __construct(
        int $upperRightX,
        int $upperRightY,
        int $coordinateX,
        int $coordinateY,
        string $direction,
        ?string $spinMove = null
    ) {
        $this->upperRightX = $upperRightX;
        $this->upperRightY = $upperRightY;
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->direction = $direction;
        $this->spinMove = $spinMove;
    }

    public function upperRightX(): int
    {
        return $this->upperRightX;
    }

    public function upperRightY(): int
    {
        return $this->upperRightY;
    }

    public function coordinateX(): int
    {
        return $this->coordinateX;
    }

    public function coordinateY(): int
    {
        return $this->coordinateY;
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public function spinMove(): ?string
    {
        return $this->spinMove;
    }
}
