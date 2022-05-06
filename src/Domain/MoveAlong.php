<?php

declare(strict_types=1);

namespace App\Domain;

final class MoveAlong
{
    public function __invoke(ElectricVehicle $electricVehicle): ElectricVehicle
    {
        $direction = $electricVehicle->getDirection()->value();
        $upperRightY = $electricVehicle->getUpperRightY()->value();
        $upperRightX = $electricVehicle->getUpperRightX()->value();

        switch ($direction) {
            case $electricVehicle::NORTH:
                $coordinate = $electricVehicle->getCoordinateY()->value() + 1;
                $coordinate = $coordinate > $upperRightY ? $upperRightY : $coordinate;
                $electricVehicle->setCoordinateY(new CoordinateY($coordinate));
                break;
            case $electricVehicle::SOUTH:
                $coordinate = $electricVehicle->getCoordinateY()->value() - 1;
                $coordinate = $coordinate < 0 ? 0 : $coordinate;
                $electricVehicle->setCoordinateY(new CoordinateY($coordinate));
                break;
            case $electricVehicle::EAST:
                $coordinate = $electricVehicle->getCoordinateX()->value() + 1;
                $coordinate = $coordinate > $upperRightX ? $upperRightX : $coordinate;
                $electricVehicle->setCoordinateX(new CoordinateX($coordinate));
                break;
            case $electricVehicle::WEST:
                $coordinate = $electricVehicle->getCoordinateX()->value() - 1;
                $coordinate = $coordinate < 0 ? 0 : $coordinate;
                $electricVehicle->setCoordinateX(new CoordinateX($coordinate));
                break;
            default:
                break;
        }

        return $electricVehicle;
    }
}
