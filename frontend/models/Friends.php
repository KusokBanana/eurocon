<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "friends".
 *
 * @property integer $id
 * @property integer $user_id_1
 * @property integer $user_id_2
 *
 */
class Friends extends ActiveRecord
{

    public $page = 1;
    public static $limit = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id_1', 'user_id_2'], 'required'],
            [['user_id_1', 'user_id_2'], 'integer'],
            [['user_id_1', 'user_id_2'], 'unique', 'targetAttribute' => ['user_id_1', 'user_id_2'], 'message' => 'The combination of User Id 1 and User Id 2 has already been taken.'],
            [['user_id_1'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['user_id_1' => 'id']],
            [['user_id_2'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['user_id_2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id_1' => 'User Id 1',
            'user_id_2' => 'User Id 2',
        ];
    }

    public static function add($user_id_from, $user_id_to)
    {

        if ($user_id_from && $user_id_to) {

            $isExist = static::isFriends($user_id_from, $user_id_to);

            if (!$isExist) {

                $hasRequest = RequestsToFriends::hasFromTo($user_id_to, $user_id_from, true);
                if ($hasRequest) {
                    $newFriends = new self();
                    $newFriends->user_id_1 = $user_id_from;
                    $newFriends->user_id_2 = $user_id_to;
                    if ($newFriends->save()) {
                        $hasRequest->delete();
                        return true;
                    }
                } else {
                    $hasRequest = RequestsToFriends::hasFromTo($user_id_to, $user_id_from);
                    if (!$hasRequest) {
                        return RequestsToFriends::add($user_id_from, $user_id_to);
                    }
                }
            }

            return false;

        }

    }

    public static function remove($user_id_from, $user_id_to)
    {

        if ($user_id_from && $user_id_to) {

            $isFriends = static::isFriends($user_id_from, $user_id_to, true);

            if ($isFriends) {
                $isFriends->delete();
                return true;
            } else {
                $hasRequest = RequestsToFriends::hasFromTo($user_id_from, $user_id_to, true);
                if ($hasRequest) {
                    $hasRequest->delete();
                    return true;
                }
            }

            return false;

        }

    }

    public static function getFriends($user_id, $page = 1, $search = '', $isAll = false)
    {

        if ($user_id) {
            $friendsLinks = static::find()
                ->where(['user_id_1' => $user_id])
                ->orWhere(['user_id_2' => $user_id])
                ->all();

            $friendsIds = [];

            if (!empty($friendsLinks)) {
                $friendsIds = $result = ArrayHelper::getColumn($friendsLinks,
                    function ($element) use ($user_id) {
                        return ($element->user_id_1 == $user_id) ? $element->user_id_2 : $element->user_id_1;
                    });
            }

            $friendsQuery = Person::find()->where(['id' => $friendsIds]);

            $friendsQuery->andFilterWhere(['LIKE', 'CONCAT(IFNULL(surname, ""), " ", IFNULL(name, ""))', $search]);

            $limit = $isAll ? null : static::$limit;

            $friends = Pagination::getData($friendsQuery, $page, $limit, 'friends');

            return $friends;
        }

    }

    /**
     * @param int $page
     * @return Friends
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    public function getOffset()
    {
        return ($this->page - 1) * static::$limit;
    }

    public static function isFriends($user_id_1, $user_id_2, $isGetObj = false)
    {
        if ($user_id_1 && $user_id_2) {
            $friends = static::find()->where(['or',
                ['user_id_1' => $user_id_1, 'user_id_2' => $user_id_2],
                ['user_id_2' => $user_id_1, 'user_id_1' => $user_id_2]])->one();

            if ($isGetObj) {
                return $friends;
            }

            return ($friends) ? true : false;
        }
    }

}
