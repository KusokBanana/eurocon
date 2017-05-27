<?php

namespace frontend\models;


class Location
{

    const LAT = 'latitude';
    const LNG = 'longitude';

    public static function get($location)
    {

        if ($location) {

            $locationArr = json_decode($location, true);
            return $locationArr;

        } else {
            return null;
        }

    }

    public static function setAttribute(&$model)
    {
        $location = $model->location;
        if ($location && is_array($location)) {
            if (isset($location[self::LAT]) && $location[self::LAT] && isset($location[self::LNG]) && $location[self::LNG]) {
                $model->location = json_encode($location);
            } else {
                $model->location = null;
            }
        }

    }

}