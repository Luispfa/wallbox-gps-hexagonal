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

final class AutoPilotBack
{
    public function __invoke(
        UpperRightX  $upperRightX,
        UpperRightY $upperRightY,
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction
    ): EvResponse {
        $electricVehicle = ElectricVehicle::create(
            $upperRightX,
            $upperRightY,
            $coordinateX,
            $coordinateY,
            $this->directionBack($direction),
            $this->spinBack()
        );

        $electricVehicleGps = (new Gps($electricVehicle))();

        return new EvResponse(
            $electricVehicleGps->getCoordinateX(),
            $electricVehicleGps->getCoordinateY(),
            $direction
        );
    }

    private function directionBack(Direction $direction): Direction
    {
        switch ($direction->value()) {
            case ElectricVehicle::NORTH:
                $back = new Direction(ElectricVehicle::SOUTH);
                break;
            case ElectricVehicle::SOUTH:
                $back = new Direction(ElectricVehicle::NORTH);
                break;
            case ElectricVehicle::EAST:
                $back = new Direction(ElectricVehicle::WEST);
                break;
            case ElectricVehicle::WEST:
                $back = new Direction(ElectricVehicle::EAST);
                break;
            default:
                break;
        }

        return $back;
    }

    private function spinBack(): SpinMove
    {
        return new SpinMove('M');
    }
}
