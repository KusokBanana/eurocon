<?php

namespace frontend\models\books;

use frontend\models\Pagination;
use frontend\models\Person;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book_followers".
 *
 * @property integer $id
 * @property integer $follower_id - a person who follows you, who clicked ‘follow’ button on your profile, your follower.
 * @property integer $following_id - a person whom you follow, you’re his/her follower,
 * you clicked ‘follow’ button on his/her profile.
 *
 * @property Person $follower
 * @property Person $following
 */
class BookFollowers extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_followers';
    }

    public static $limit = 12;

    const TYPE_FOLLOWER = 1;
    const TYPE_FOLLOWING = 2;
    const TYPE_ALL = 3;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['follower_id', 'following_id'], 'required'],
            [['follower_id', 'following_id'], 'integer'],
            [['follower_id', 'following_id'], 'unique', 'targetAttribute' => ['follower_id', 'following_id'],
                'message' => 'The combination of Follower ID and Following ID has already been taken.'],
            [['follower_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Person::className(), 'targetAttribute' => ['follower_id' => 'id']],
            [['following_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Person::className(), 'targetAttribute' => ['following_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'follower_id' => 'Follower',
            'following_id' => 'Following',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollower()
    {
        return $this->hasOne(Person::className(), ['id' => 'follower_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollowing()
    {
        return $this->hasOne(Person::className(), ['id' => 'following_id']);
    }

    public function getPerson()
    {
        return $this->hasOne(Person::className(), []);
    }


    public static function isFollowingTo($follower_id, $following_id)
    {

        return static::find()
            ->where(['follower_id' => $follower_id, 'following_id' => $following_id])
            ->one();

    }

    public static function follow($follower_id, $following_id)
    {

        if ($follower_id && $following_id) {

            $isExist = static::isFollowingTo($follower_id, $following_id);

            if (!$isExist) {
                $newFollower = new self();
                $newFollower->following_id = $following_id;
                $newFollower->follower_id = $follower_id;
                if ($newFollower->save())
                    return true;
            }

            return false;
        }

    }

    public static function unFollow($follower_id, $following_id)
    {

        if ($follower_id && $following_id) {

            $follow = static::isFollowingTo($follower_id, $following_id);

            if ($follow) {
                $follow->delete();
                return true;
            }

            return false;

        }

    }

    public static function getFollows($user_id, $page = 1, $search = '', $type = self::TYPE_ALL, $isAll = false)
    {

        if ($user_id) {

            switch ($type) {
                case self::TYPE_FOLLOWER:
                    $where = ['follower_id' => $user_id];
                    break;
                case self::TYPE_FOLLOWING:
                    $where = ['following_id' => $user_id];
                    break;
                default:
                    $where = ['or', ['follower_id' => $user_id], ['following_id' => $user_id]];
                    break;
            }

            $follows = static::find()
                ->where($where)
                ->all();

            $followsIds = [];

            if (!empty($follows)) {
                $followsIds = ArrayHelper::getColumn($follows,
                    function ($element) use ($user_id) {
                        return ($element->following_id == $user_id) ? $element->follower_id : $element->following_id;
                    });
            }

            $friendsQuery = Person::find()->where(['id' => $followsIds]);

            $friendsQuery->andFilterWhere(['LIKE', 'CONCAT(IFNULL(surname, ""), " ", IFNULL(name, ""))', $search]);

            $limit = $isAll ? null : static::$limit;

            $friends = Pagination::getData($friendsQuery, $page, $limit, 'followers');

            return $friends;
        }

    }

    public static function getPossiblePeopleToSubscribeForCurrentUser()
    {
        $user = Yii::$app->user;
        $people = [];
        if (!$user->isGuest) {
            $people = static::getFollows($user->id, 1, '', BookFollowers::TYPE_ALL, true)['data'];
        }

        return $people;


    }

}
