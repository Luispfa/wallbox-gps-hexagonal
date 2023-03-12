<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\AutoPilot;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use function Lambdish\Phunctional\flatten as PhunctionalFlatten;

final class AutoPilotController
{
    private $autoPilot;

    public function __construct(AutoPilot $autoPilot)
    {
        $this->autoPilot = $autoPilot;
    }

    /**
     * @Route("/auto-pilot", name="auto-pilot", methods={"GET"})
     */
    public function autoPilot(): Response
    {
        try {
            $upperRightX = 5;
            $upperRightY = 5;

            $movements = [
                'coordinateX1' => 1,
                'coordinateY1' => 2,
                'direction1' => 'N',
                'spinMove1' => 'LMLMLMLMM',
                'coordinateX2' => 3,
                'coordinateY2' => 3,
                'direction2' => 'E',
                'spinMove2' => 'MMRMMRMRRM',
                'coordinateX3' => 3,
                'coordinateY3' => 3,
                'direction3' => 'E',
                'spinMove3' => 'MMRMMRMRLM',
            ];
            $response = $this->autoPilot->__invoke($upperRightX, $upperRightY, PhunctionalFlatten($movements));

            return new JsonResponse($response->evs());
        } catch (\Throwable $th) {
            return new Response($th->getMessage());
        }
    }
}
