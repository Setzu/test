<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 21:43
 */

namespace Test\Service;


use Test\Interfaces\FileInterface;

class File extends AbstractService implements FileInterface
{

    public $inputFileName;
    public $outputFileName;
    public $content;

    const BASE_PATH = __DIR__ . '/../../../data/files/';
    const TRANSFORM_PATH = __DIR__ . '/../../../data/files/transform/';

    /**
     * Files constructor.
     * @param string $sFileName
     * @param string $sFileContent
     * @throws \Exception
     */
    public function __construct($sFileName, $sFileContent)
    {
        if (!is_string($sFileName) || empty($sFileName)) {
            throw new \Exception('Invalid file name.');
        }

        $this->setInputFileName($sFileName);
        $this->setContent($sFileContent);
    }

    /**
     * @throws \Exception
     */
    public function addFile($tranformed = false)
    {
        if ($tranformed) {
            return fputs(fopen(self::BASE_PATH . $this->getOutputFileName(), 'a+'), $this->getContent());
        } else {
            return fputs(fopen(self::BASE_PATH . $this->getInputFileName(), 'a+'), $this->getContent());
        }
    }

    /**
     * First transform method
     * @throws \Exception
     */
    public function addDigits()
    {
        $aFileContent = preg_split('/\n|\r\n?/', $this->getContent());
        $sNewContent = '';

        foreach ($aFileContent as $line) {
            $sNewContent .= rand(10000, 99999) . ' : ' . $line . "\r\n";
        }

        $this->setContent($sNewContent);

        return $this->addFile(true);
    }


    /**
     * Second transform method
     * @throws \Exception
     */
    public function shuffle()
    {
        $aFileContent = preg_split('/\n|\r\n?/', $this->getContent());
        $sNewContent = '';

        foreach ($aFileContent as $line) {
            $sNewContent .= str_shuffle($line) . "\r\n";
        }

        $this->setContent($sNewContent);

        return $this->addFile(true);
    }

    public function transform($tranformMethod)
    {
        if (!method_exists($this, $tranformMethod)) {
            throw new \Exception('The method ' . $tranformMethod . ' does not exists');
        }

        $this->setOutputFileName('transformed_with_' . $tranformMethod . '_' . $this->getInputFileName());

        return $this->$tranformMethod();
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getInputFileName()
    {
        return $this->inputFileName;
    }

    /**
     * @param mixed $inputFileName
     */
    public function setInputFileName($inputFileName)
    {
        $this->inputFileName = $inputFileName;
    }

    /**
     * @return mixed
     */
    public function getOutputFileName()
    {
        return $this->outputFileName;
    }

    /**
     * @param mixed $outputFileName
     */
    public function setOutputFileName($outputFileName)
    {
        $this->outputFileName = $outputFileName;
    }
}