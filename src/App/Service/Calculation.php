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
     * @param bool $normal
     */
    public function definePeriodRate(Loan $loan, $normal = false)
    {
        if ($normal) {
            $loan->setPeriodRate(pow(1+$loan->getRate(), 1/12) - 1);

            return;
        }

        $loan->setPeriodRate($loan->getRate()/12);
    }

    /**
     * @param Loan $loan
     */
    public function defineAmount(Loan $loan)
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
            $this->defineAmount($loan);
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
     * @param Loan $loan
     */
    public function defineCapital(Loan $loan)
    {
        if (null === $loan->getPeriodRate()) {
            $this->definePeriodRate($loan);
        }

        $capital = $loan->getAmount() * (1-(1/pow(1+$loan->getPeriodRate(), $loan->getDuration()))) / $loan->getPeriodRate();
        $loan->setCapital($capital);
    }

    /**
     * @param Loan $loan
     */
    public function defineCost(Loan $loan)
    {
        $cost = 0;
        foreach ($loan->getTable() as $monthly) {
            $cost += $monthly->getInterest();
        }
        $loan->setCost($cost);
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
