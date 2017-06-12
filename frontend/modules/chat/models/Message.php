<?php

namespace frontend\modules\chat\models;

/**
 * Class Message
 * @package frontend\models\chat
 *
 */
class Message extends db\Message
{
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'sender_id' => 'sender_id',
            'text',
            'created_at' => 'created_at',
            'date' => function ($model) {
                return static::formatDate($model['created_at'])[1];
            },
            'when' => function ($model) {
                return static::formatDate($model['created_at'])[0];
            },
            'sender' => function ($model) {
                return $model['sender'];
            },
        ];
    }

    public static function formatDate($value)
    {
        $today = date_create()->setTime(0, 0, 0);
        $date = date_create($value)->setTime(0, 0, 0);
        if ($today == $date) {
            $label = 'Today';
        } elseif ($today->getTimestamp() - $date->getTimestamp() == 24 * 60 * 60) {
            $label = 'Yesterday';
        } elseif ($today->format('W') == $date->format('W') && $today->format('Y') == $date->format('Y')) {
            $label = \Yii::$app->formatter->asDate($value, 'php:l');
        } elseif ($today->format('Y') == $date->format('Y')) {
            $label = \Yii::$app->formatter->asDate($value, 'php:d F');
        } else {
            $label = \Yii::$app->formatter->asDate($value, 'medium');
        }
        $formatted = \Yii::$app->formatter->asTime($value, 'short');
        return [$label, $formatted];
    }
}
