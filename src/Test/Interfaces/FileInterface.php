<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 21:14
 */

namespace Test\Interfaces;


interface FileInterface
{

    public function setInputFileName($inputFileName);

    public function setOutputFileName($outputFileName);

    public function transform($tranformMethod);

}