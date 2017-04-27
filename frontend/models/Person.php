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

    private static $quest_id = 5;
    private static $avatar_path = '/upload/avatars/person/';
    private static $default_avatar = '@web/img/portraits/5.jpg';
    private static $minutes_ago_online = 5;

    public $last_access = 'never';
    public $is_online = false;
    public $full_name;

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
                $query->andOnCondition(['type_id' => Tag::PROJECT_TYPE]);
            }], true, 'LEFT OUTER JOIN');
    }

    public function getUsersForCompanies()
    {
        return $this->hasMany(BookUserCompany::className(), ['user_id' => 'id']);
    }

    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id' => 'company_id'])
            ->via('usersForCompanies');
    }

    public static function getPerson($user)
    {

//        if ($user->isGuest) {
//            return self::findOne(self::$quest_id);
//        } else {
            return self::findOne($user->id);
//        }

    }

    public function getProjectsData($page = 1, $search = '')
    {

        $query = $this->getProjects();
        $query->andFilterWhere(['LIKE', Project::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Project::$limit, 'projects');

    }

    public function getCompaniesData($page = 1, $search = '')
    {
        $query = $this->getCompanies();
        $query->andFilterWhere(['LIKE', Company::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Company::$limit, 'communities');
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
