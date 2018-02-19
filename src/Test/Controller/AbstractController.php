<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/16
 * Time: 20:28
 */

namespace Test\Controller;

use Test\Stdlib\Layout;
use Test\Stdlib\SessionManager;

abstract class AbstractController extends SessionManager
{

    protected $aVariables = [];
    protected $sView;
    protected $layout;

    const DEFAULT_DIRECTORY = 'index';
    const DEFAULT_VIEW = 'index';

    abstract function indexAction();

    /**
     * Create properties for each values of $aVariables table
     *
     * @param array $aVariables
     * @return $this
     * @throws \Exception
     */
    protected function setVariables(array $aVariables)
    {
        foreach ($aVariables as $sName => $mValue) {
            if (!is_string($sName)) {
                throw new \Exception('La clé doit être une chaîne de caractères.');
            }

            $this->{$sName} = $mValue;
        }

        return $this;
    }

    /**
     * @param string $sName
     * @param mixed $mValue
     * @return mixed
     * @throws \Exception
     */
    protected function updateVariables($sName, $mValue)
    {
        if (!is_string($sName)) {
            throw new \Exception('Le nom de la variable doit être une chaîne de caractères.');
        } elseif (!property_exists($this, $sName)) {
            return $this->setVariables([$sName => $mValue]);
        }

        return $this->{$sName} = $mValue;
    }

    /**
     * Display view
     *
     * @param string $directory
     * @param string $view
     * @param bool $loadLayout
     * @return mixed
     * @throws \Exception
     */
    protected function render($directory = '', $view = '', $loadLayout = true)
    {
        if (empty($directory) || !is_string($directory)) {
            $directory = self::DEFAULT_DIRECTORY;
        }

        if (empty($view) || !is_string($view)) {
            $view = self::DEFAULT_VIEW;
        }

        $sFilePath = __DIR__ . '/../View/' . $directory . '/' . $view . '.php';

        // Contrôle de l'existence du fichier
        if (file_exists($sFilePath)) {
            if ($loadLayout) {
                $oLayout = new Layout();

                $this->setVariables([
                    'content' => $sFilePath
                ]);

                return require_once $oLayout->getLayout();
            }

            return require_once $sFilePath;
        } else {
            throw new \Exception('Le fichier ' . $sFilePath . ' n\'a pas été trouvé.');
        }
    }

    /**
     * Redirect to /ControllerName/ActionName
     *
     * @param string $controller
     * @param string $action
     * @throws \Exception
     */
    protected function redirect($controller = '', $action = '')
    {
        $sControllerName = (string) strtolower(trim($controller));
        $sActionName = (string) strtolower(trim($action));

        if (!empty($sActionName)) {
            header('Location: /' . $sControllerName . '/' . $sActionName);
        } else {
            header('Location: /' . $sControllerName);
        }
    }

    /**
     * Display the 404 view
     *
     * @return string
     * @throws \Exception
     */
    public function pageNotFound()
    {
        if (!file_exists(__DIR__ . '/../View/error/404.php')) {
            throw new \Exception('The 404 view does not found.');
        }

        return $this->render('error', '404');
    }
}