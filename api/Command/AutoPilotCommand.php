<?php

declare(strict_types=1);

namespace Api\Command;

use App\Application\AutoPilot;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AutoPilotCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:auto-pilot';
    protected static $defaultDescription = 'GPS.';

    private $autoPilot;

    public function __construct(AutoPilot $autoPilot)
    {
        $this->autoPilot = $autoPilot;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Execute Auto Pilot')
            ->addArgument('upperRightX', InputArgument::REQUIRED, 'Upper-right X coordinate')
            ->addArgument('upperRightY', InputArgument::REQUIRED, 'Upper-right Y coordinate')
            ->addArgument('movements', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Initial positions and moves of the electric vehicles, each vehicle represented by an array with four elements: coordinateX, coordinateY, direction, spinMove.')
            ->setHelp('allow to navigate of electric vehicles (EV) with autopilot ...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $upperRightX = (int) $input->getArgument('upperRightX');
        $upperRightY = (int) $input->getArgument('upperRightY');
        $movements = $input->getArgument('movements');

        $response = $this->autoPilot->__invoke($upperRightX, $upperRightY, $movements);

        $section1 = $output->section();
        foreach ($response->evs() as $r) {
            $section1->writeln($r);
        }

        return 0;
    }
}
