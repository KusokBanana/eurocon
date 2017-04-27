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

    public static function addToFriends($user_id_1, $user_id_2)
    {

        if ($user_id_1 && $user_id_2) {

            $isExist = static::find()->where(['or',
                ['user_id_1' => $user_id_1, 'user_id_2' => $user_id_2],
                ['user_id_2' => $user_id_1, 'user_id_1' => $user_id_2]])->one();

            if (!$isExist) {
                $newRequest = new Friends();
                $newRequest->user_id_1 = $user_id_1;
                $newRequest->user_id_2 = $user_id_2;
                $newRequest->save();
            }

        }

    }

    public static function getFriends($user_id, $page = 1, $search = '')
    {

        if ($user_id) {
            $friendsLinks = static::find()
                ->where(['user_id_1' => $user_id])
                ->orWhere(['user_id_2' => $user_id])
                ->all();

            $friends = [];

            if (!empty($friendsLinks)) {
                $friendsIds = $result = ArrayHelper::getColumn($friendsLinks,
                    function ($element) use ($user_id) {
                        return ($element->user_id_1 == $user_id) ? $element->user_id_2 : $element->user_id_1;
                    });

                $friendsQuery = Person::find()->where(['id' => $friendsIds]);

                $friendsQuery->andFilterWhere(['LIKE', 'CONCAT(IFNULL(surname, ""), " ", IFNULL(name, ""))', $search]);

                $friends = Pagination::getData($friendsQuery, $page, static::$limit, 'friends');
            }

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


}
