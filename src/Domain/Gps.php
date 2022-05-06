<?php

declare(strict_types=1);

namespace App\Domain;

final class Gps
{
    private $electricVehicle;
    
    public function __construct(ElectricVehicle $electricVehicle)
    {
        $this->electricVehicle = $electricVehicle;
    }

    public function __invoke(): ElectricVehicle
    {
        $spinMove = $this->electricVehicle->getSpinMove();
        $spinMoveToArray = str_split($spinMove->value());
        foreach ($spinMoveToArray as $spin) {
            if ($spin == $this->electricVehicle::MOVE) {
                $moveAlong = new MoveAlong();
                $this->electricVehicle = $moveAlong($this->electricVehicle);
            } else {
                $spinDirection = new SpinDirection();
                $this->electricVehicle = $spinDirection($this->electricVehicle, $spin);
            }
        }

        return $this->electricVehicle;
    }
}
