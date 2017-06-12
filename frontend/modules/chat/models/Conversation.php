<?php

namespace frontend\modules\chat\models;

use frontend\models\Person;
use yii\db\ActiveQuery;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * Class Conversation
 * @package frontend\models\chat
 *
 * @property-read Person contact
 *
 */
class Conversation extends db\Conversation
{
    /**
     * @return ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Person::className(), ['id' => 'contact_id']);
    }

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'lastMessage' => function ($model) {
                return [
                    'text' => StringHelper::truncate($model['lastMessage']['text'], 20),
                    'date' => static::formatDate($model['lastMessage']['created_at']),
                    'senderId' => $model['lastMessage']['sender_id'],
                    'id' => $model['lastMessage']['id'],
                ];
            },
            'newMessages' => function ($model) {
                return [
                    'count' => count($model['newMessages'])
                ];
            },
            'contact' => function ($model) {
                return $model['contact'];
            },
            'loadUrl',
            'sendUrl',
            'deleteUrl',
            'readUrl',
            'unreadUrl',
        ];
    }

    /**
     * @inheritDoc
     */
    protected static function baseQuery($userId)
    {
        return parent::baseQuery($userId)->with(['newMessages', 'contact']);
    }

    public static function formatDate($value)
    {
        $today = date_create()->setTime(0, 0, 0);
        $date = date_create($value)->setTime(0, 0, 0);
        if ($today == $date) {
            $formatted = \Yii::$app->formatter->asTime($value, 'short');
        } elseif ($today->getTimestamp() - $date->getTimestamp() == 24 * 60 * 60) {
            $formatted = 'Yesterday';
        } elseif ($today->format('W') == $date->format('W') && $today->format('Y') == $date->format('Y')) {
            $formatted = \Yii::$app->formatter->asDate($value, 'php:l');
        } elseif ($today->format('Y') == $date->format('Y')) {
            $formatted = \Yii::$app->formatter->asDate($value, 'php:d F');
        } else {
            $formatted = \Yii::$app->formatter->asDate($value, 'medium');
        }
        return $formatted;
    }

    public function getLoadUrl()
    {
        $url = Url::to(['messages','contactId' => $this->contact_id]);
        return $url;
    }

    public function getSendUrl()
    {
        return Url::to(['create-message','contactId' => $this->contact_id]);
    }

    public function getDeleteUrl()
    {
        return Url::to(['delete-conversation','contactId' => $this->contact_id]);
    }

    public function getReadUrl()
    {
        return Url::to(['mark-conversation-as-read','contactId' => $this->contact_id]);
    }

    public function getUnreadUrl()
    {
        return Url::to(['mark-conversation-as-unread','contactId' => $this->contact_id]);
    }
}
