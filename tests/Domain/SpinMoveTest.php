<?php

namespace Tests\Domain;

use App\Domain\SpinMove;
use Exception;
use PHPUnit\Framework\TestCase;

class SpinMoveTest extends TestCase
{
    public function testItShouldReturnLeft()
    {
        $spin = new SpinMove('L');
        self::assertEquals('L', $spin->value());
    }

    public function testItShouldReturnRight()
    {
        $spin = new SpinMove('R');
        self::assertEquals('R', $spin->value());
    }

    public function testItShouldReturnMove()
    {
        $spin = new SpinMove('M');
        self::assertEquals('M', $spin->value());
    }

    public function testItShouldReturnExceptionAboutAllowedCharacter()
    {
        $this->expectException(Exception::class);
        $spin = new SpinMove('a');
    }

    public function testItShouldReturnExceptionAboutNotString()
    {
        $this->expectException(Exception::class);
        $spin = new SpinMove(5);
    }
}
