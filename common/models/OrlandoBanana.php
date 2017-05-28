<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 29.04.2017
 * Time: 0:59
 */

namespace common\models;


use frontend\models\Tag;

class OrlandoBanana
{

    public static function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name . $extension;
    }

}