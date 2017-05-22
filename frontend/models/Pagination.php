<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 22.04.2017
 * Time: 20:27
 */

namespace frontend\models;


use yii\db\ActiveQuery;
use yii\db\Query;

class Pagination
{

    /**
     * @param $query ActiveQuery
     * @param $page int
     * @param $limit int
     * @param $type string
     * @return array
     */
    public static function getData($query, $page, $limit, $type)
    {

        $offset = ($page - 1) * $limit;
        $count = $query->count();

        if (!is_null($limit))
            $query->limit($limit)->offset($offset);

        return [
            'count' => $count,
            'page' => $page,
            'pageCount' => $limit,
            'type' => $type,
            'data' => $query->all()
        ];

    }



//    /**
//     * @param int $page
//     * @return Person
//     */
//    public function setPage($page)
//    {
//        $this->page = $page;
//        return $this;
//    }

}