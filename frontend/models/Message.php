<?php
/**
 * Created by PhpStorm.
 * User: kusok
 * Date: 19.04.2017
 * Time: 16:23
 */

namespace frontend\models;


class Message extends \bubasuma\simplechat\db\Message
{
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            //...
            'text',
            'date' => 'created_at',
            //...
        ];
    }

}