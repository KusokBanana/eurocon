<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $birthday
 * @property string $phone
 * @property string $image
 * @property string $surname
 * @property string $name
 */
class Person extends User
{

    public static $quest_id = 5;
    private static $avatar_path = '/upload/avatars/person/';
    private static $default_avatar = '@web/img/portraits/5.jpg';
    private static $minutes_ago_online = 5;

    const RELATION_SELF = 1;
    const RELATION_FRIEND = 2;
    const RELATION_REQUEST_FROM = 3;
    const RELATION_REQUEST_TO = 4;

    public $last_access = 'never';
    public $is_online = false;
    public $full_name;
    public $relation = false;

    public static $limit = 12;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name'], 'required'],
            [['birthday'], 'safe'],
            [['username', 'email'], 'string', 'max' => 255],
            [['phone', 'image', 'surname', 'name'], 'string', 'max' => 65],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
//            'auth_key' => 'Auth Key',
//            'password_hash' => 'Password Hash',
//            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
//            'status' => 'Status',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'image' => 'Image',
            'surname' => 'Surname',
            'name' => 'Name',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['field_id' => 'id']);
    }

    public function getUsersForProjects()
    {
        return $this->hasMany(BookUserProject::className(), ['user_id' => 'id']);
    }

    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id'])
            ->via('usersForProjects')
            ->joinWith(['tags' => function($query) {
                $query->andOnCondition([Tag::tableName().'.type_id' => Tag::PROJECT_TYPE]);
            }], true, 'LEFT OUTER JOIN');
    }

    public function getParticipants()
    {
        return $this->hasMany(BookUserCommunity::className(), ['user_id' => 'id']);
    }

    public function getAdmins()
    {
        return $this->hasMany(BookAdminsCommunity::className(), ['admin_id' => 'id']);
    }

    public function getCompanies()
    {
        return $this->hasMany(Community::className(), ['id' => 'community_id'])
            ->via('participants')->via('admins');
    }

    public static function getPerson($user)
    {

        if ($user) {
            if (isset($user->isGuest) && $user->isGuest) {
                return self::findOne(self::$quest_id);
            } else {
                return self::findOne($user->id);
            }
        }

    }

    public function getProjectsData($page = 1, $search = '')
    {

        $query = $this->getProjects();
        $query->andFilterWhere(['LIKE', Project::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Project::$limit, 'projects');

    }

    public function getCommunitiesData($page = 1, $search = '')
    {
        $query = $this->getCompanies();
        $query->andFilterWhere(['LIKE', Community::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Community::$limit, 'communities');
    }

    public function afterFind()
    {
        parent::afterFind();

        $lastAccess = SessionFrontendUser::find()->where(['user_id' => $this->id])->one();
        if ($lastAccess) {
            $this->last_access = $this->getLastAccess($lastAccess->expire);
            $this->is_online = (self::$minutes_ago_online - (time() - $lastAccess->expire + 3600)  > 0) ? true : false;
            // TODO remove 3600 cause of local server time +3
        }

        $this->full_name = $this->surname . ($this->surname ? ' ' : '') . $this->name;

        $this->setImage();
    }

    public function addToFriends($user_id)
    {
        return Friends::add($user_id, $this->id);
    }

    public function removeFromFriends($user_id)
    {
        return Friends::remove($user_id, $this->id);
    }

    public function setRelation($user)
    {

        if ($this->id === $user->id) {
            $this->relation = self::RELATION_SELF;
        } else {
            $isHasRequest = RequestsToFriends::isHasRequest($this->id, $user->id, true);
            if ($isHasRequest) {
                if ($isHasRequest == RequestsToFriends::REQUEST_TYPE_FROM)
                    $this->relation = self::RELATION_REQUEST_FROM;
                elseif ($isHasRequest == RequestsToFriends::REQUEST_TYPE_TO)
                    $this->relation = self::RELATION_REQUEST_TO;
            } else {
                $isFriend = Friends::isFriends($user->id, $this->id);
                if ($isFriend) {
                    $this->relation = self::RELATION_FRIEND;
                }
            }
        }

    }

    private function setImage()
    {

        $image = $this->image;
        $path = Yii::getAlias('@frontend') . '/web' . self::$avatar_path;
        $isImageExist = file_exists($path . $image);
        if ($image && $isImageExist) {
            $this->image = Yii::getAlias('@web') . self::$avatar_path . $image;
        } else {
            $this->image = static::$default_avatar;
        }

    }

    private function getLastAccess($timestamp)
    {
        if($timestamp > (time() - (3600*24))) {

        // Calculate time difference
            if($timestamp > time() - 3600) {

                // Count minutes ago
                $diff = time() - $timestamp;

                $diff += 3600; // TODO remove this row because of local server +3 hours

                $minutes = $diff / 60;

                return intval($minutes) . " minutes ago";

            } else {

                $diff = time() - $timestamp;

                $diff += 3600; // TODO remove this row because of local server +3 hours

                $hours = $diff / 3600;

                return intval($hours) . " hours ago";

            }

        } else {
            return "at" . date("x-y-z", $timestamp);
        }

    }



}
