<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\ElectricVehicle;
use App\Domain\Gps;
use App\Domain\SpinMove;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;

final class AutoPilotQueryHandler implements QueryHandler
{
    private $gps;

    public function __construct(Gps $gps)
    {
        $this->gps = $gps;
    }

    public function __invoke(AutoPilotQuery $query): ElectricVehicle
    {
        $upperRightX = new UpperRightX($query->upperRightX());
        $upperRightY = new UpperRightY($query->upperRightY());
        $coordinateX = new CoordinateX($query->coordinateX(), $query->upperRightX());
        $coordinateY = new CoordinateY($query->coordinateY(), $query->upperRightY());
        $direction = new Direction($query->direction());
        $spinMove = new SpinMove($query->spinMove());

        return $this->gps->__invoke(
            $upperRightX,
            $upperRightY,
            $coordinateX,
            $coordinateY,
            $direction,
            $spinMove
        );
    }
}
