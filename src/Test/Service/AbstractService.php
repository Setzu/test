<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:43
 */

namespace Test\Service;


abstract class AbstractService
{

    /**
     * @param AbstractService $oClasse
     * @param array $aInfos
     * @throws \Exception
     */
    public function hydrate(AbstractService $oClasse, array $aInfos)
    {
        foreach($aInfos as $attribut => $value) {

            $method = 'set' . str_replace('_', '', ucfirst(strtolower($attribut)));

            if (!method_exists($oClasse, $method)) {
                throw new \Exception('The set' . ucfirst(strtolower($attribut)) . ' method from class ' .
                get_class($oClasse) . ' does not exist.');
            }

            $oClasse->$method($value);
        }
    }
}