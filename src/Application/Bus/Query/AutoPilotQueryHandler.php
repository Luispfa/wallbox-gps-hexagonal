<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Application\AutoPilot;
use App\Domain\Bus\Query\QueryHandler;
use App\Domain\CoordinateX;
use App\Domain\CoordinateY;
use App\Domain\Direction;
use App\Domain\Response\EvResponse;
use App\Domain\SpinMove;
use App\Domain\UpperRightX;
use App\Domain\UpperRightY;

final class AutoPilotQueryHandler implements QueryHandler
{
    private $autoPilot;

    public function __construct(AutoPilot $autoPilot)
    {
        $this->autoPilot = $autoPilot;
    }

    public function __invoke(AutoPilotQuery $query): EvResponse
    {
        return $this->autoPilot->__invoke(
            new UpperRightX($query->upperRightX()),
            new UpperRightY($query->upperRightY()),
            new CoordinateX($query->coordinateX()),
            new CoordinateY($query->coordinateY()),
            new Direction($query->direction()),
            new SpinMove($query->spinMove())
        );
    }
}
