<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:36
 */

namespace Test\Stdlib;


class Layout
{

    private $layout;

    /**
     * Layout constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!file_exists(__DIR__ . '/../View/layout/layout.php')) {
            throw new \Exception('Le fichier ' . __DIR__ . '/../View/layout/layout.php est introuvable');
        }

        $this->setLayout(__DIR__ . '/../View/layout/layout.php');
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}