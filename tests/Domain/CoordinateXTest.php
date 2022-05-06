<?php

namespace Tests\Domain;

use App\Domain\CoordinateX;
use Exception;
use PHPUnit\Framework\TestCase;

class CoordinateXTest extends TestCase
{
    public function testItShouldReturnInteger()
    {
        $coordinate = new CoordinateX(1);
        self::assertEquals(1, $coordinate->value());
    }

    public function testItShouldReturnExceptionAboutLessThanZero()
    {
        $this->expectException(Exception::class);
        $coordinate = new CoordinateX(-1);
    }
}
