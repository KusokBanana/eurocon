<?php
namespace frontend\modules\chat\models\db;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Class MessageQuery
 * @package frontend\models\chat\db
 *
 */
class MessageQuery extends ActiveQuery
{
    public function init()
    {
        parent::init();
        $this->alias('m');
//        $this->addSelect(['new_count' => new Expression('COUNT(DISTINCT ch.id)')])
//            ->join('LEFT JOIN', 'chat_message ch',
//                'ch.sender_id = c.sender_id AND ch.receiver_id = :userId AND ch.is_new = 1')
    }

    /**
     * @param int $userId
     * @param int $contactId
     * @return $this
     * @since 2.0
     */
    public function between($userId, $contactId)
    {
        return $this->andWhere(['or',
            ['sender_id' => $contactId, 'receiver_id' => $userId/*, 'is_deleted_by_receiver' => false*/],
            ['sender_id' => $userId, 'receiver_id' => $contactId/*, 'is_deleted_by_sender' => false*/],
        ]);
    }
}
