<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 21:43
 */

namespace Test\Service;


class File extends AbstractService
{

    public $name;
    public $type;
    public $tmpName;
    public $size;
    public $uploadDate;
    public $error;

    const BASE_PATH = __DIR__ . '/../../../data/files/';
    const TRANSFORM_PATH = __DIR__ . '/../../../data/files/transform/';

    /**
     * Files constructor.
     * @throws \Exception
     */
    public function __construct($aFileDatas = [])
    {
        if (is_array($aFileDatas) && count($aFileDatas) > 0) {
            $this->hydrate($this, $aFileDatas);
            $this->addFile($this);
        }
    }

    /**
     * @param File $file
     */
    public function addFile(File $file)
    {
        if (!file_exists(self::BASE_PATH)) {
            mkdir(self::BASE_PATH, 0777, true);
        }

        $pathFile = self::BASE_PATH . $this->getName();

        if (!file_exists($pathFile)) {
            move_uploaded_file($file->getTmpName(), $pathFile);
        }
    }

    public function transform(File $file)
    {
        if (!file_exists(self::BASE_PATH)) {
            mkdir(self::BASE_PATH, 0777, true);
        } elseif(!file_exists(self::TRANSFORM_PATH)) {
            mkdir(self::TRANSFORM_PATH, 0777, true);
        }


    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getUploadDate()
    {
        return $this->uploadDate;
    }

    /**
     * @param mixed $uploadDate
     */
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmpName;
    }

    /**
     * @param mixed $tmpName
     */
    public function setTmpName($tmpName)
    {
        $this->tmpName = $tmpName;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }
}