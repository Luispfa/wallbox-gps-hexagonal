<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\Bus\Query\AutoPilotQuery;
use App\Domain\Bus\Query\QueryHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class AutoPilotController
{
    private $queryHandler;

    public function __construct(QueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    /**
     * @Route("/auto-pilot", name="auto-pilot", methods={"GET"})
     */
    public function autoPilot(): Response
    {
        try {
            $upperyRightX = 5;
            $upperyRightY = 5;
    
            $coordinateX = 1;
            $coordinateY = 2;
            $direction = 'N';
    
            $spinMove = 'LMLMLMLMM';
    
            // $coordinateX = 3;
            // $coordinateY = 3;
            // $direction = 'E';
    
            // $spinMove = 'MMRMMRMRRM';
    
    
            $query = $this->queryHandler;
            $response = $query(new AutoPilotQuery(
                $upperyRightX,
                $upperyRightY,
                $coordinateX,
                $coordinateY,
                $direction,
                $spinMove
            ));
    
            return new Response($response());
        } catch (\Throwable $th) {
            return new Response($th->getMessage());
        }
        
    }
}
