<?php

namespace App\Command;

use App\Entity\Loan;
use Ndewez\ApplicationConsoleBundle\Command\ContainerCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CapacityCommand.
 */
class CapacityCommand extends ContainerCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('app:capacity')
            ->setDescription('Calculation of payments capacity')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $loan = new Loan();
        $loan->setAmount(1144.47);
        $loan->setRate(0.022);
        $loan->setDuration(240);

        $this->container->get('app.calculation')->definePeriodRate($loan);
        $this->container->get('app.calculation')->defineCapital($loan);
        dump($loan->getCapital());

        $this->container->get('app.calculation')->definePeriodRate($loan, true);
        $this->container->get('app.calculation')->defineCapital($loan);
        dump($loan->getCapital());
    }
}
