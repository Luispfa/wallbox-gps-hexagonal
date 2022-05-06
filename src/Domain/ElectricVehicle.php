<?php

declare(strict_types=1);

namespace App\Domain;

final class ElectricVehicle
{
    private  $upperRightX, $upperRightY, $coordinateX, $coordinateY, $direction, $spinMove;

    const NORTH = 'N';
    const SOUTH = 'S';
    const EAST = 'E';
    const WEST = 'W';
    const RIGHT = 'R';
    const LEFT = 'L';
    const MOVE = 'M';


    public function __construct(
        UpperRightX  $upperRightX,
        UpperRightY $upperRightY,
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction,
        SpinMove $spinMove
    ) {
        $this->upperRightX = $upperRightX;
        $this->upperRightY = $upperRightY;
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->direction = $direction;
        $this->spinMove = $spinMove;
    }

    public static function create(
        UpperRightX  $upperRightX,
        UpperRightY $upperRightY,
        CoordinateX $coordinateX,
        CoordinateY $coordinateY,
        Direction $direction,
        SpinMove $spinMove
    ): self {
        return new self(
            $upperRightX,
            $upperRightY,
            $coordinateX,
            $coordinateY,
            $direction,
            $spinMove
        );
    }

    public function getUpperRightX(): UpperRightX
    {
        return $this->upperRightX;
    }

    public function getUpperRightY(): UpperRightY
    {
        return $this->upperRightY;
    }

    public function getCoordinateX(): CoordinateX
    {
        return $this->coordinateX;
    }

    public function setCoordinateX(CoordinateX $coordinateX): void
    {
        $this->coordinateX = $coordinateX;
    }

    public function getCoordinateY(): CoordinateY
    {
        return $this->coordinateY;
    }

    public function setCoordinateY(CoordinateY $coordinateY): void
    {
        $this->coordinateY = $coordinateY;
    }

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function setDirection(Direction $direction): void
    {
        $this->direction = $direction;
    }

    public function getSpinMove(): SpinMove
    {
        return $this->spinMove;
    }

    public function setSpinMove(SpinMove $spinMove): void
    {
        $this->spinMove = $spinMove;
    }
}
