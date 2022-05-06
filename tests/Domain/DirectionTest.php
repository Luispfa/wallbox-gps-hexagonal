<?php

namespace Tests\Domain;

use App\Domain\Direction;
use Exception;
use PHPUnit\Framework\TestCase;

class DirectionTest extends TestCase
{
    public function testItShouldReturnNorth()
    {
        $direction = new Direction('N');
        self::assertEquals('N', $direction->value());
    }

    public function testItShouldReturnSouth()
    {
        $direction = new Direction('S');
        self::assertEquals('S', $direction->value());
    }

    public function testItShouldReturnEast()
    {
        $direction = new Direction('E');
        self::assertEquals('E', $direction->value());
    }

    public function testItShouldReturnWest()
    {
        $direction = new Direction('W');
        self::assertEquals('W', $direction->value());
    }

    public function testItShouldReturnExceptionAboutAllowedCharacter()
    {
        $this->expectException(Exception::class);
        $direction = new Direction('a');
    }

    public function testItShouldReturnExceptionAboutLength()
    {
        $this->expectException(Exception::class);
        $direction = new Direction('MM');
    }

    public function testItShouldReturnExceptionAboutNotString()
    {
        $this->expectException(Exception::class);
        $direction = new Direction(5);
    }
}
