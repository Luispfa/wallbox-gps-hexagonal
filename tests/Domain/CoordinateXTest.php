<?php

namespace Tests\Domain;

use App\Domain\CoordinateX;
use PHPUnit\Framework\TestCase;

class CoordinateXTest extends TestCase
{
    public function testItShouldReturnInteger()
    {
        $coordinate = new CoordinateX(1, 5);
        self::assertEquals(1, $coordinate->value());
    }

    public function testItShouldReturnExceptionAboutLessThanZero()
    {
        $this->expectException(\Exception::class);
        new CoordinateX(-10, 5);
    }

    public function testItShouldReturnExceptionAboutGreaterThanMaxValue()
    {
        $this->expectException(\Exception::class);
        new CoordinateX(6, 5);
    }
}
