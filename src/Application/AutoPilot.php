<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\ElectricVehicle;
use App\Domain\Gps;
use App\Domain\Response\EvResponse;
use App\Domain\SpinMove;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;

final class AutoPilot
{
    public function __invoke(
        UpperRightX  $upperRightX,
        UpperRightY $upperRightY,
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction,
        SpinMove $spinMove
    ): EvResponse {
        $electricVehicle = ElectricVehicle::create($upperRightX, $upperRightY, $coordinateX, $coordinateY, $direction, $spinMove);

        $electricVehicleGps = (new Gps($electricVehicle))();

        return new EvResponse(
            $electricVehicleGps->getCoordinateX(),
            $electricVehicleGps->getCoordinateY(),
            $electricVehicleGps->getDirection()
        );
    }
}
