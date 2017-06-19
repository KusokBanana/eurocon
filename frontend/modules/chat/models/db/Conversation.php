<?php

namespace frontend\modules\chat\models\db;

use frontend\modules\chat\models\DataProvider;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Class Conversation
 * @package frontend\models\chat\db
 *
 * @property int $user_id
 * @property int contact_id
 * @property int last_message_id
 * @property int new
 *
 * @property-read Message $lastMessage
 * @property-read Message[] $newMessages
 *
 */
class Conversation extends ActiveRecord
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'last_message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewMessages()
    {
        return $this->hasMany(Message::className(), ['sender_id' => 'contact_id', 'receiver_id' => 'user_id'])
            ->andOnCondition(['is_new' => true]);
    }

    /**
     * @param int $userId
     * @param int $limit
     * @param bool $history
     * @param int $key
     * @return DataProvider
     * @since 2.0
     */
    public static function get($userId, $limit, $history = true, $key = null)
    {
        $query = static::baseQuery($userId);
        if (null !== $key) {
            $query->andHaving([$history ? '<' : '>', 'last_message_id', $key]);
        }
        return new DataProvider([
            'query' => $query,
            'key' => 'last_message_id',
            'pagination' => [
                'pageSize' => $limit
            ]
        ]);
    }

    public static function getDataForMiniChat($userId, $isOnlyCount = false)
    {
        $return = [];
        if (!$isOnlyCount) {
            $conversations = static::find()
                ->forUser($userId)
                ->addSelect([
                    'user_id' => new Expression(':userId'),
                    'new' => new Expression('IF(c.sender_id != :userId AND c.is_new = 1, 1, 0)')
                ])
                ->orderBy(['new' => SORT_DESC, 'last_message_id' => SORT_DESC])
                ->with('lastMessage')
                ->with('contact')
                ->limit(4)
                ->all();
            $return['conversations'] = $conversations;
        }

        $countNewConversations = Message::find()
            ->where(['is_new' => 1, 'receiver_id' => $userId])
            ->groupBy(['sender_id'])
            ->count();

        return ArrayHelper::merge($return, ['countNew' => $countNewConversations]);
    }

    /**
     * @param int $userId
     * @return static
     */
    public static function recent($userId)
    {
        return static::baseQuery($userId)->one();
    }

    /**
     * @param int $userId
     * @return ConversationQuery
     */
    protected static function baseQuery($userId)
    {
        return static::find()
            ->forUser($userId)
            ->addSelect(['user_id' => new Expression(':userId')])
            ->with('lastMessage')
            ->orderBy(['last_message_id' => SORT_DESC]);
    }

    /**
     * @param string $userId
     * @param string $contactId
     * @return array the number of rows updated
     */
    public static function remove($userId, $contactId)
    {
        $count = static::updateAll([
            'is_deleted_by_sender' => new Expression('IF([[sender_id]] = :userId, TRUE, is_deleted_by_sender)'),
            'is_deleted_by_receiver' => new Expression('IF([[receiver_id]] = :userId, TRUE, is_deleted_by_receiver)')
        ], ['or',
            ['receiver_id' => new Expression(':userId'), 'sender_id' => $contactId, 'is_deleted_by_receiver' => false],
            ['sender_id' => new Expression(':userId'), 'receiver_id' => $contactId, 'is_deleted_by_sender' => false],
        ], [
            'userId' => $userId
        ]);
        return compact('count');
    }

    /**
     * @param $userId
     * @param $contactId
     * @return array the number of rows updated
     */
    public static function read($userId, $contactId)
    {
        $count = static::updateAll([
                'is_new' => false
            ], [
                'receiver_id' => $userId,
                'sender_id' => $contactId,
                'is_new' => true
            ]);
        return compact('count');
    }

    /**
     * @param $userId
     * @param $contactId
     * @return array
     */
    public static function unread($userId, $contactId)
    {
        /** @var Message $message */
        $message = Message::find()
            ->where(['sender_id' => $contactId, 'receiver_id' => $userId/*, 'is_deleted_by_receiver' => false*/])
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();
        $count = 0;
        if ($message) {
            $message->is_new = 1;
            $count = intval($message->update());
        }
        return compact('count');
    }

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return Message::tableName();
    }


    /**
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function beforeDelete()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function beforeValidate()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function attributes()
    {
        return ['user_id', 'contact_id', 'last_message_id', 'new'];
    }

    /**
     * @inheritdoc
     */
    public static function populateRecord($record, $row)
    {
        foreach (['user_id', 'contact_id'] as $name) {
            if (isset($row[$name])) {
                $row[$name] = intval($row[$name]);
            }
        }
        parent::populateRecord($record, $row);
    }

    /**
     * @return ConversationQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(ConversationQuery::className(), [get_called_class()]);
    }

    public function getLoadUrl()
    {
        return '';
    }

    public function getSendUrl()
    {
        return '';
    }

    public function getDeleteUrl()
    {
        return '';
    }

    public function getReadUrl()
    {
        return '';
    }

    public function getUnreadUrl()
    {
        return '';
    }
}
