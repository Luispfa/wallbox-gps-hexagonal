<?php

namespace Tests\Domain;

use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\ElectricVehicle;
use App\Domain\SpinDirection;
use App\Domain\SpinMove;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;
use PHPUnit\Framework\TestCase;

class SpinDirectionTest extends TestCase
{
    public function testItShouldReturnWest()
    {
        $mock = $this->mock();

        $spin = new SpinDirection();
        $electricVehicle = $spin($mock, 'L');

        self::assertInstanceOf(SpinDirection::class, $spin);
        self::assertEquals('W', $electricVehicle->getDirection());
    }

    public function testItShouldReturnEast()
    {
        $mock = $this->mock();

        $spin = new SpinDirection();
        $electricVehicle = $spin($mock, 'R');

        self::assertInstanceOf(SpinDirection::class, $spin);
        self::assertEquals('E', $electricVehicle->getDirection());
    }

    public function testItShouldReturnNorth()
    {
        $mock = $this->mock();
        $mock->setDirection(new Direction('W'));

        $spin = new SpinDirection();
        $electricVehicle = $spin($mock, 'R');

        self::assertInstanceOf(SpinDirection::class, $spin);
        self::assertEquals('N', $electricVehicle->getDirection());
    }

    public function testItShouldReturnSouth()
    {
        $mock = $this->mock();
        $mock->setDirection(new Direction('W'));

        $spin = new SpinDirection();
        $electricVehicle = $spin($mock, 'L');

        self::assertInstanceOf(SpinDirection::class, $spin);
        self::assertEquals('S', $electricVehicle->getDirection());
    }

    private function mock()
    {
        return new ElectricVehicle(
            new UpperRightX(5),
            new UpperRightY(5),
            new CoordinateX(1),
            new CoordinateY(2),
            new Direction('N'),
            new SpinMove('LMLMLMLMM')
        );
    }
}
