<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Query\AutoPilotQuery;
use App\Application\Bus\Query\AutoPilotQueryHandler;
use App\Application\Response\EvResponse;
use App\Application\Response\EvsResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class AutoPilot
{
    private $queryHandler;

    public function __construct(AutoPilotQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(int  $upperRightX, int $upperRightY, array $movements): EvsResponse
    {
        $queries = $this->getMultiplesQueries($upperRightX, $upperRightY, $movements);
        $electricVehicle = $this->queryHandler->__invoke($queries);
        $responses = $this->getMultiplesResponse($electricVehicle);

        return new EvsResponse(...PhunctionalMap(EvResponse::toResponse(), $responses));
    }

    private function getMultiplesQueries(int $upperRightX, int $upperRightY, array $movements): array
    {
        return PhunctionalMap(
            function ($move) use ($upperRightX, $upperRightY) {
                $coordinateX = (int) $move[0];
                $coordinateY = (int) $move[1];
                $direction = (string) $move[2];
                $spinMove = (string) $move[3];

                return new AutoPilotQuery(
                    $upperRightX,
                    $upperRightY,
                    $coordinateX,
                    $coordinateY,
                    $direction,
                    $spinMove
                );
            },
            array_chunk($movements, 4) // groups the array into chunks of 4 elements
        );
    }

    private function getMultiplesResponse(array $electricVehicles): array
    {
        return PhunctionalMap(function ($electricVehicle) {
            return new EvResponse(
                $electricVehicle->getCoordinateX(),
                $electricVehicle->getCoordinateY(),
                $electricVehicle->getDirection()
            );
        }, $electricVehicles);
    }
}
