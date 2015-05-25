<?php

namespace App\Entity;

/**
 * Class Monthly.
 */
class Monthly extends Data
{
    /** @var int */
    protected $number;

    /** @var float */
    protected $capital;

    /** @var float */
    protected $interest;

    /** @var float */
    protected $total;

    /** @var float */
    protected $capitalConsumed;

    /** @var float */
    protected $capitalAfter;

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

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
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param float $interest
     */
    public function setInterest($interest)
    {
        $this->interest = $this->round($interest);
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $this->round($total);
    }

    public function calculateTotal()
    {
        $this->total = $this->round($this->interest + $this->capitalConsumed);
    }

    /**
     * @return float
     */
    public function getCapitalConsumed()
    {
        return $this->capitalConsumed;
    }

    /**
     * @param float $capitalConsumed
     */
    public function setCapitalConsumed($capitalConsumed)
    {
        $this->capitalConsumed = $this->round($capitalConsumed);
    }

    /**
     * @return float
     */
    public function getCapitalAfter()
    {
        return $this->capitalAfter;
    }

    /**
     * @param float $capitalAfter
     */
    public function setCapitalAfter($capitalAfter)
    {
        $this->capitalAfter = $this->round($capitalAfter);
    }
}
