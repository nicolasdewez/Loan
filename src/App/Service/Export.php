<?php

namespace App\Service;

use App\Entity\Monthly;

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
    }

    /**
     * @param Monthly[] $table
     *
     * @return string
     */
    public function createTable(array $table)
    {
        $path = __PATH_DATA__.'/table.html';
        file_put_contents($path, $this->twig->render('table.html.twig', ['table' => $table]));

        return realpath($path);
    }
}
