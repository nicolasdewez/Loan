<?php

namespace App\Service;

use App\Entity\Loan;
use App\Entity\Monthly;

/**
 * Class Calculation.
 */
class Calculation
{
    const CAPITAL_LIMIT = 50;

    /**
     * @param Loan $loan
     */
    public function definePeriodRate(Loan $loan)
    {
        $loan->setPeriodRate($loan->getRate()/12);
    }

    /**
     * @param Loan $loan
     */
    public function defineMonthlyPayment(Loan $loan)
    {
        if (null === $loan->getPeriodRate()) {
            $this->definePeriodRate($loan);
        }

        $amount = ($loan->getCapital() * $loan->getPeriodRate())/(1 - pow(1 + $loan->getPeriodRate(), -1 * $loan->getDuration()));
        $loan->setAmount($amount);
    }

    /**
     * @param Loan $loan
     */
    public function defineTable(Loan $loan)
    {
        if (null === $loan->getAmount()) {
            $this->defineMonthlyPayment($loan);
        }

        $table = [];
        $capital = $loan->getCapital();
        $number = 1;
        do {
            $monthly = new Monthly();
            $monthly->setNumber($number++);
            $monthly->setCapital($capital);
            $this->defineMonthly($monthly, $loan, $capital);

            $capital = $monthly->getCapitalAfter();
            $table[] = $monthly;
        } while ($capital >= self::CAPITAL_LIMIT);

        $loan->setTable($table);
    }

    /**
     * @param Monthly $monthly
     * @param Loan    $loan
     * @param float   $capital
     */
    protected function defineMonthly(Monthly $monthly, Loan $loan, $capital)
    {
        $monthly->setInterest($loan->getPeriodRate() * $capital);
        $monthly->setCapitalConsumed($loan->getAmount() - $monthly->getInterest());
        $monthly->setCapitalAfter($capital - $monthly->getCapitalConsumed());
        $monthly->calculateTotal();

        if ($monthly->getCapitalAfter() <= self::CAPITAL_LIMIT) {
            $monthly->setCapitalConsumed($monthly->getCapitalConsumed() + $monthly->getCapitalAfter());
            $monthly->calculateTotal();
            $monthly->setCapitalAfter(0);
        }
    }
}
