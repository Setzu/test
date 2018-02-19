<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 21:01
 */

namespace Test\Controller;


use Test\Service\File;

class IndexController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        if (!empty($_POST) && count($_FILES) > 0) {
            if (array_key_exists('userfile', $_FILES)) {
                $aFilesInfos = $_FILES['userfile'];

                if ($_FILES['userfile']['type'] != 'text/plain' && $_FILES['userfile']['size'] > 1000000) {
                    $this->setFlashMessage('Le fichier ne doit pas dépasser 1 Mo et doit être de type txt');

                    return $this->redirect();
                }

                $aFilesInfos['uploadDate'] = date('d/m/Y H:i:s');

                $oFile = new File($aFilesInfos);
            }
        }

        return $this->render();
    }
}