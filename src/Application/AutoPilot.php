<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Query\AutoPilotQuery;
use App\Application\Bus\Query\AutoPilotQueryHandler;
use App\Application\Response\EvResponse;

final class AutoPilot
{
    private $queryHandler;

    public function __construct(AutoPilotQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(
        int  $upperRightX,
        int $upperRightY,
        int $coordinateX,
        int $coordinateY,
        string $direction,
        string $spinMove
    ): EvResponse {
        $query = new AutoPilotQuery($upperRightX, $upperRightY, $coordinateX, $coordinateY, $direction, $spinMove);
        $electricVehicle = $this->queryHandler->__invoke($query);

        return new EvResponse(
            $electricVehicle->getCoordinateX(),
            $electricVehicle->getCoordinateY(),
            $electricVehicle->getDirection()
        );
    }
}
