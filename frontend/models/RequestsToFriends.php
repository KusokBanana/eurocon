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

    const REQUEST_TYPE_FROM = 1;
    const REQUEST_TYPE_TO = 2;

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

            $isExist = static::isHasRequest($from_user, $to_user);

            if (!$isExist) {
                $newRequest = new RequestsToFriends();
                $newRequest->from_user_id = $from_user;
                $newRequest->to_user_id = $to_user;
                if ($newRequest->save())
                    return true;
            }

            return false;
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

    public static function isHasRequest($user_id_from, $user_id_to, $isWithDescribe = false)
    {
        $request = static::find()->where(['or',
            ['from_user_id' => $user_id_from, 'to_user_id' => $user_id_to],
            ['to_user_id' => $user_id_from, 'from_user_id' => $user_id_to]])->one();
        if ($request) {
            if ($isWithDescribe) {
                return ($request->from_user_id == $user_id_from) ? self::REQUEST_TYPE_FROM : self::REQUEST_TYPE_TO;
            }
            return true;
        }
        return false;
    }

    public static function hasFromTo($user_id_from, $user_id_to, $isGetObj = false)
    {
        $request = static::find()->where(['from_user_id' => $user_id_from, 'to_user_id' => $user_id_to])->one();
        if ($isGetObj) {
            return $request;
        }
        return ($request) ? true : false;
    }

}
