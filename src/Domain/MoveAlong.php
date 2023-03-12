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
                $coordinate = min($coordinate, $upperRightY);
                $electricVehicle->setCoordinateY(new CoordinateY($coordinate));
                break;
            case $electricVehicle::SOUTH:
                $coordinate = $electricVehicle->getCoordinateY()->value() - 1;
                $coordinate = max($coordinate, 0);
                $electricVehicle->setCoordinateY(new CoordinateY($coordinate));
                break;
            case $electricVehicle::EAST:
                $coordinate = $electricVehicle->getCoordinateX()->value() + 1;
                $coordinate = min($coordinate, $upperRightX);
                $electricVehicle->setCoordinateX(new CoordinateX($coordinate));
                break;
            case $electricVehicle::WEST:
                $coordinate = $electricVehicle->getCoordinateX()->value() - 1;
                $coordinate = max($coordinate, 0);
                $electricVehicle->setCoordinateX(new CoordinateX($coordinate));
                break;
            default:
                throw new \InvalidArgumentException('Invalid direction value');
        }

        return $electricVehicle;
    }
}
