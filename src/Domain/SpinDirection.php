<?php

declare(strict_types=1);

namespace App\Domain;

final class SpinDirection
{
    private $electricVehicle;

    public function __invoke(ElectricVehicle $electricVehicle, string $spin): ElectricVehicle
    {
        $this->electricVehicle = $electricVehicle;

        $direction = $this->electricVehicle->getDirection();
        switch ($direction->value()) {
            case $this->electricVehicle::NORTH:
                $this->spinNorth($spin);
                break;
            case $this->electricVehicle::SOUTH:
                $this->spinSouth($spin);
                break;
            case $this->electricVehicle::EAST:
                $this->spinEast($spin);
                break;
            case $this->electricVehicle::WEST:
                $this->spinWest($spin);
                break;
            default:
                break;
        }

        return $this->electricVehicle;
    }

    private function spinNorth(string $spin): void
    {
        if ($spin == $this->electricVehicle::LEFT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::WEST));
        }
        if ($spin == $this->electricVehicle::RIGHT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::EAST));
        }
    }

    private function spinSouth(string $spin): void
    {
        if ($spin == $this->electricVehicle::LEFT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::EAST));
        }
        if ($spin == $this->electricVehicle::RIGHT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::WEST));
        }
    }

    private function spinEast(string $spin): void
    {
        if ($spin == $this->electricVehicle::LEFT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::NORTH));
        }
        if ($spin == $this->electricVehicle::RIGHT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::SOUTH));
        }
    }

    private function spinWest(string $spin): void
    {
        if ($spin == $this->electricVehicle::LEFT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::SOUTH));
        }
        if ($spin == $this->electricVehicle::RIGHT) {
            $this->electricVehicle->setDirection(new Direction($this->electricVehicle::NORTH));
        }
    }
}
