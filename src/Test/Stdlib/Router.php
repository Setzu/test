<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:06
 */

namespace Test\Stdlib;

use Test\Controller;

class Router
{
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION = 'indexAction';

    /**
     * Détermine le controller et l'action à appeler en fonction des paramètres passés dans l'url
     *
     * @return mixed
     * @throws \Exception
     */
    public static function dispatch()
    {
        if (!empty($_GET['controller'])) {
            $sController = ucfirst(strtolower(trim(htmlspecialchars($_GET['controller'])))) . 'Controller';
        } else {
            $sController = self::DEFAULT_CONTROLLER;
        }

        $sControllerName = 'Test\\Controller\\' . $sController;

        if (!class_exists($sControllerName)) {
            return (new Controller\IndexController())->pageNotFound();
        }

        if (!empty($_GET['action'])) {
            $sActionName = ucfirst(strtolower(trim(htmlspecialchars($_GET['action'])))) . 'Action';
        } else {
            $sActionName = self::DEFAULT_ACTION;
        }

        if (!method_exists($sControllerName, $sActionName)) {
            return (new Controller\IndexController())->pageNotFound();
        }

        return (new $sControllerName)->$sActionName();
    }
}
