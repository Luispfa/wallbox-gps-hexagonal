<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Application\AutoPilotBack;
use App\Domain\Bus\Query\QueryHandler;
use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\Response\EvResponse;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;

final class AutoPilotBackQueryHandler implements QueryHandler
{
    private $autoPilotBack;

    public function __construct(AutoPilotBack $autoPilotBack)
    {
        $this->autoPilotBack = $autoPilotBack;
    }

    public function __invoke(AutoPilotQuery $query): EvResponse
    {
        return $this->autoPilotBack->__invoke(
            new UpperRightX($query->upperRightX()),
            new UpperRightY($query->upperRightY()),
            new CoordinateX($query->coordinateX(), $query->upperRightX()),
            new CoordinateY($query->coordinateY(), $query->upperRightY()),
            new Direction($query->direction())
        );
    }
}
