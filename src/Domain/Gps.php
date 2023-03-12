<?php

declare(strict_types=1);

namespace App\Domain;

final class Gps
{
    public function __invoke(
        UpperRightX $upperRightX,
        UpperRightY $upperRightY,
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction,
        SpinMove $spinMove
    ): ElectricVehicle {
        $electricVehicle = ElectricVehicle::create(
            $upperRightX,
            $upperRightY,
            $coordinateX,
            $coordinateY,
            $direction,
            $spinMove
        );

        $spinMove = $electricVehicle->getSpinMove();
        $spinMoveToArray = str_split($spinMove->value());
        foreach ($spinMoveToArray as $spin) {
            if ($spin == $electricVehicle::MOVE) {
                $this->moveAlong($electricVehicle);
            } else {
                $this->spinDirection($electricVehicle, $spin);
            }
        }

        return $electricVehicle;
    }

    private function moveAlong(ElectricVehicle $electricVehicle): void
    {
        $moveAlong = new MoveAlong();
        $electricVehicle = $moveAlong($electricVehicle);
    }

    private function spinDirection(ElectricVehicle $electricVehicle, string $spin): void
    {
        $spinDirection = new SpinDirection();
        $electricVehicle = $spinDirection($electricVehicle, $spin);
    }
}
