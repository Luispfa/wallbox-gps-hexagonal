<?php

declare(strict_types=1);

namespace Api\Command;

use App\Application\Bus\Query\AdFinderQuery;
use App\Application\Bus\Query\AutoPilotQuery;
use App\Domain\Bus\Query\QueryHandler;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AutoPilotCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:auto-pilot';
    protected static $defaultDescription = 'GPS.';

    private $queryHandler;

    public function __construct(QueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('parameters', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'upperyRightX upperyRightY coordinateX1 coordinateY1 direction1 spinMove1
                                                                                                                      coordinateX2 coordinateY2 direction2 spinMove2
                                                                                                                      .........')
            ->setHelp('allow to navigate of electric vehicles (EV) with autopilot ...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $parameters = $input->getArgument('parameters');

        $upperyRightX = (int)$parameters[0];
        $upperyRightY = (int)$parameters[1];
        for ($i = 2; $i < count($parameters); $i++) {
            $coordinateX = (int)$parameters[$i];
            $coordinateY = (int)$parameters[++$i];
            $direction = $parameters[++$i];
            $spinMove = $parameters[++$i];

            $response = $this->autoPilot($upperyRightX,  $upperyRightY, $coordinateX, $coordinateY, $direction, $spinMove);

            $section1 = $output->section();
            $section1->writeln($response);
        }
        return 0;
    }

    private function autoPilot(int $upperyRightX, int $upperyRightY, int $coordinateX, int $coordinateY, string $direction, string $spinMove): Response
    {
        try {
            $query = $this->queryHandler;
            $response = $query(new AutoPilotQuery(
                $upperyRightX,
                $upperyRightY,
                $coordinateX,
                $coordinateY,
                $direction,
                $spinMove
            ));

            $response = new Response($response());
        } catch (\Throwable $th) {
            $response =  new Response($th->getMessage());
        }

        return $response;
    }
}
