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
        $sSourceFile = File::BASE_PATH . 'source.txt';

        if (!file_exists($sSourceFile)) {
            throw new \Exception('The source file doesn\'t exist');
        }

        $aFilesList = scandir(File::BASE_PATH);

        // retrait des 2 valeurs '.' et '..' présentes par défaut (c'est moche mais manque de temps :/)
        array_shift($aFilesList);
        array_shift($aFilesList);

        if (!empty($_POST) && array_key_exists('filename', $_POST)) {

            $sFileName = str_replace(' ', '_', strtolower(htmlspecialchars(trim($_POST['filename']))));

            $sFile = $sFileName . '.txt';

            if(file_exists(File::BASE_PATH . $sFile)) {
                $this->setFlashMessage('A file with this name already exists.', false);

                return $this->redirect();
            }

            $sSourceFileContent = file_get_contents($sSourceFile);
            $oServiceFile = new File($sFile, $sSourceFileContent);
            $oServiceFile->addFile();
            $oServiceFile->transform('addDigits');
            $oServiceFile->transform('shuffle');

            $this->setVariables(['aFilesList' => $aFilesList]);
            $this->setFlashMessage('The file has been added with success', false);

            return $this->redirect();
        }

        $this->setVariables(['aFilesList' => $aFilesList]);

        return $this->render();
    }

    public function uploadAction()
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