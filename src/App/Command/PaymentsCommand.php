<?php

namespace App\Command;

use App\Entity\Loan;
use Ndewez\ApplicationConsoleBundle\Command\ContainerCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PaymentsCommand.
 */
class PaymentsCommand extends ContainerCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('app:payments')
            ->setDescription('Calculation of monthly payments')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $loan = new Loan();
        $loan->setCapital(220000);
        $loan->setRate(0.023);
        $loan->setDuration(240);

        $this->container->get('app.calculation')->defineTable($loan);
    }
}
