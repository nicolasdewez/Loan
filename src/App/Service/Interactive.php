<?php

namespace App\Service;

use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use App\Exception\BadResponseException;

/**
 * Class Interactive.
 */
class Interactive
{
    /**
     * @return Question
     */
    public function getCapitalQuestion()
    {
        $question = new Question('<question>Please enter capital (ex -> 200000) :</question> ');
        $question->setValidator(function ($answer) {
            if (!is_numeric($answer)) {
                throw new BadResponseException('Value numeric is required');
            }

            if (0 >= $answer) {
                throw new BadResponseException('Value must be greater than zero');
            }

            return (float) $answer;
        });
        $question->setMaxAttempts(2);

        return $question;
    }

    /**
     * @return Question
     */
    public function getAmountQuestion()
    {
        $question = new Question('<question>Please enter amount (ex -> 1100.5) :</question> ');
        $question->setValidator(function ($answer) {
            if (!is_numeric($answer)) {
                throw new BadResponseException('Value numeric is required');
            }

            if (0 >= $answer) {
                throw new BadResponseException('Value must be greater than zero');
            }

            return (float) $answer;
        });
        $question->setMaxAttempts(2);

        return $question;
    }

    /**
     * @return Question
     */
    public function getRateQuestion()
    {
        $question = new Question('<question>Please enter rate (ex -> 2.15) :</question> ');
        $question->setValidator(function ($answer) {
            if (!is_numeric($answer)) {
                throw new BadResponseException('Value numeric is required');
            }

            if (0 >= $answer) {
                throw new BadResponseException('Value must be greater than zero');
            }

            return (float) $answer/100;
        });
        $question->setMaxAttempts(2);

        return $question;
    }

    /**
     * @return ConfirmationQuestion
     */
    public function getNormalRateQuestion()
    {
        return new ConfirmationQuestion('<question>Would you use normal rate ?</question> ', true);
    }

    /**
     * @return Question
     */
    public function getDurationQuestion()
    {
        $question = new Question('<question>Please enter duration in month (ex -> 240) :</question> ');
        $question->setValidator(function ($answer) {
            if (!is_numeric($answer)) {
                throw new BadResponseException('Value numeric is required');
            }

            if (0 >= $answer) {
                throw new BadResponseException('Value must be integer greater than zero');
            }

            return (int) $answer;
        });
        $question->setMaxAttempts(2);

        return $question;
    }

    /**
     * @return ConfirmationQuestion
     */
    public function getTableQuestion()
    {
        return new ConfirmationQuestion('<question>Would you like generate payments table ?</question> ', true);
    }
}
