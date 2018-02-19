<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 19/02/18
 * Time: 20:36
 */

namespace Test\Service;

class Utils
{

    /**
     * PHP debugger
     *
     * @param mixed $value
     * @param bool $die
     */
    public static function debug($value, $die = true)
    {
        echo '<pre>'; var_dump($value);
        echo '<br><br>';
        debug_print_backtrace();

        if ($die) {
            echo '</pre>';
            die();
        } else {
            echo '!! End of debug !!</pre>';
        }
    }
}