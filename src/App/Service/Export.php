<?php

namespace App\Service;

use App\Entity\Loan as LoanEntity;

/**
 * Class Export.
 */
class Export
{
    /** @var \Twig_Environment */
    protected $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->twig->getLoader()->addPath(__PATH_VIEWS__);
        if (!file_exists(__PATH_DATA__)) {
            mkdir(__PATH_DATA__);
        }
    }

    /**
     * @param LoanEntity $loan
     *
     * @return string
     */
    public function createTable(LoanEntity $loan)
    {
        $date = new \DateTime();
        $path = sprintf('%s/table_%s.html', __PATH_DATA__, $date->format('Ymd_His'));
        file_put_contents($path, $this->twig->render('table.html.twig', ['loan' => $loan]));

        return realpath($path);
    }
}
