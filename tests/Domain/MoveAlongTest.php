<?php

namespace Tests\Domain;

use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\ElectricVehicle;
use App\Domain\MoveAlong;
use App\Domain\SpinMove;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;
use PHPUnit\Framework\TestCase;

class MoveAlongTest extends TestCase
{
    public function testItShouldReturnIncreaseY()
    {
        $mock = $this->mock();
        $mock->setCoordinateY(new CoordinateY(2));
        $mock->setDirection(new Direction('N'));

        $move = new MoveAlong();
        $electricVehicle = $move($mock);

        self::assertInstanceOf(MoveAlong::class, $move);
        self::assertEquals(3, $electricVehicle->getCoordinateY()->value());
    }

    public function testItShouldReturnDecreaseY()
    {
        $mock = $this->mock();
        $mock->setCoordinateY(new CoordinateY(2));
        $mock->setDirection(new Direction('S'));

        $move = new MoveAlong();
        $electricVehicle = $move($mock);

        self::assertInstanceOf(MoveAlong::class, $move);
        self::assertEquals(1, $electricVehicle->getCoordinateY()->value());
    }   

    public function testItShouldReturnIncreaseX()
    {
        $mock = $this->mock();
        $mock->setCoordinateX(new CoordinateX(2));
        $mock->setDirection(new Direction('E'));

        $move = new MoveAlong();
        $electricVehicle = $move($mock);

        self::assertInstanceOf(MoveAlong::class, $move);
        self::assertEquals(3, $electricVehicle->getCoordinateX()->value());
    }

    public function testItShouldReturnDecreaseX()
    {
        $mock = $this->mock();
        $mock->setCoordinateX(new CoordinateX(2));
        $mock->setDirection(new Direction('W'));

        $move = new MoveAlong();
        $electricVehicle = $move($mock);

        self::assertInstanceOf(MoveAlong::class, $move);
        self::assertEquals(1, $electricVehicle->getCoordinateX()->value());
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
