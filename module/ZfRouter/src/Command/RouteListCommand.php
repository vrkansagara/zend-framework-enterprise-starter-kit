<?php

namespace ZfRouter\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RouteListCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'route:list';

    protected function configure()
    {
        $this->setDescription('Application route list')
            ->setHelp('List all available route list.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
    }
}
