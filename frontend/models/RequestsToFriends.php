<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "requests_to_friends".
 *
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 *
 * @property Person $fromUser
 * @property Person $toUser
 */
class RequestsToFriends extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requests_to_friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id'], 'required'],
            [['from_user_id', 'to_user_id'], 'integer'],
            [['from_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['from_user_id' => 'id']],
            [['to_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['to_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(Person::className(), ['id' => 'from_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(Person::className(), ['id' => 'to_user_id']);
    }

    public static function add($from_user, $to_user)
    {

        if ($from_user && $to_user) {

            $isExist = static::find()->where(['or',
                ['from_user_id' => $from_user, 'to_user_id' => $to_user],
                ['to_user_id' => $from_user, 'from_user_id' => $to_user]])->one();

            if (!$isExist) {
                $newRequest = new RequestsToFriends();
                $newRequest->from_user_id = $from_user;
                $newRequest->to_user_id = $to_user;
                $newRequest->save();
            }

        }

    }

    public static function getRequestsForUser($user_id)
    {
        if ($user_id) {
            $income = static::find()->where(['to_user_id' => $user_id])->joinWith('fromUser')->all();
            $outcome = static::find()->where(['from_user_id' => $user_id])->joinWith('toUser')->all();
            return compact('income', 'outcome');
        }
    }

}
