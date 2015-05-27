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
        $interactive = $this->container->get('app.interactive');
        $calculation = $this->container->get('app.calculation');
        $helper = $this->getHelper('question');

        $question = $interactive->getCapitalQuestion();
        $capital = $helper->ask($input, $output, $question);

        $question = $interactive->getRateQuestion();
        $rate = $helper->ask($input, $output, $question);

        $question = $interactive->getNormalRateQuestion();
        $normalRate = $helper->ask($input, $output, $question);

        $question = $interactive->getDurationQuestion();
        $duration = $helper->ask($input, $output, $question);

        $loan = new Loan();
        $loan->setCapital($capital);
        $loan->setRate($rate);
        $loan->setDuration($duration);

        $calculation->definePeriodRate($loan, $normalRate);
        $calculation->defineAmount($loan);
        $calculation->defineTable($loan);
        $calculation->defineCost($loan);

        $output->writeln(sprintf('<info>Amount : %.2f</info>', $loan->getAmount()));

        $question = $interactive->getTableQuestion();
        $table = $helper->ask($input, $output, $question);
        if ($table) {
            $path = $this->container->get('app.export')->createTable($loan);
            $output->writeln(sprintf('<info>Payments table generated into %s</info>', $path));
        }
    }
}
