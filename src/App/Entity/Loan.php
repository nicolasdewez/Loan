<?php

namespace App\Entity;

/**
 * Class Loan.
 */
class Loan extends Data
{
    /** @var float */
    protected $capital;

    /** @var float */
    protected $rate;

    /** @var float */
    protected $periodRate;

    /** @var int */
    protected $duration;

    /** @var float */
    protected $amount;

    /** @var Monthly[] */
    protected $table;

    /**
     * @return float
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * @param float $capital
     */
    public function setCapital($capital)
    {
        $this->capital = $this->round($capital);
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return float
     */
    public function getPeriodRate()
    {
        return $this->periodRate;
    }

    /**
     * @param float $periodRate
     */
    public function setPeriodRate($periodRate)
    {
        $this->periodRate = $periodRate;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $this->round($amount);
    }

    /**
     * @return Monthly[]
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param Monthly[] $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}
