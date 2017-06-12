<?php

namespace frontend\modules\chat\models\db;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Class ConversationQuery
 *
 */
class ConversationQuery extends ActiveQuery
{
    public function init()
    {
        parent::init();
        $this->alias('c');
        $this->select([
                 'last_message_id' => new Expression('MAX([[c.id]])'),
                 'contact_id' => new Expression('IF([[c.sender_id]] = :userId, [[c.receiver_id]], [[c.sender_id]])'),
//                 'new_count' => new Expression('COUNT(DISTINCT ch.id)')
            ])
//            ->join('LEFT JOIN', 'chat_message ch',
//                'ch.sender_id = c.sender_id AND ch.receiver_id = :userId AND ch.is_new = 1')
//            ->andWhere(['or',
//                ['receiver_id' => new Expression(':userId'), 'is_deleted_by_receiver' => false],
//                ['sender_id' => new Expression(':userId'), 'is_deleted_by_sender' => false],
//            ])
            ->groupBy(['contact_id']);
    }

    /**
     * @param int $userId
     * @return $this
     * @since 2.0
     */
    public function forUser($userId)
    {
        return $this->addParams(['userId' => $userId]);
    }

}
