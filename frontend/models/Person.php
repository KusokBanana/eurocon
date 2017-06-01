<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use common\models\User;
use frontend\assets\LocationsAsset;
use frontend\models\books\BookAdminCommunity;
use frontend\models\books\BookAdminCompany;
use frontend\models\books\BookFollowers;
use frontend\models\books\BookOwnerProject;
use frontend\models\books\BookUserCommunity;
use frontend\models\books\BookUserCompany;
use frontend\models\books\BookUserProject;
use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\UploadedFile;

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
 * @property integer $gender_id
 * @property string $position
 * @property string $location
 * @property string $language_ids
 * @property string $site
 * @property integer $chat_me_able_id
 * @property integer $invite_project_able_id
 * @property string $notice_ids
 * @property string $background [varchar(126)]
 */
class Person extends User
{

    public static $quest_id = 5;
    private static $avatar_path = '/upload/person/';
    private static $default_avatar = '@web/img/portraits/5.jpg';
    private static $minutes_ago_online = 5;

    const RELATION_SELF = 1;
    const RELATION_FOLLOWING = 2;

    public $last_access = 'never';
    public $is_online = false;
    public $full_name;
    public $relation = false;
    public $imageFile;
    public $backgroundFile;
    public $imageShow;
    public $backgroundShow;
    public $tagValues;

    public static $genders = [
        1 => 'Male',
        2 => 'Female',
    ];

    public static $limit = 12;

    public static $languages = [
        1 => 'Englsih',
        2 => 'German',
        3 => 'French',
        4 => 'Russian',
        5 => 'Chinese',
    ];

    const NOTICE_FRIENDS = 1;
    const NOTICE_COMMUNITIES = 2;
    const NOTICE_COMPANIES = 3;

    const CAN_ONLY_FRIENDS = 1;
    const CAN_FRIENDS = 2;
    const CAN_EVERYONE = 3;

    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender_id', 'chat_me_able_id', 'invite_project_able_id'], 'integer'],
            [['username', 'name'], 'required'],
            [['birthday'], 'safe'],
            [['username', 'email'], 'string', 'max' => 255],
            [['phone', 'image', 'surname', 'name'], 'string', 'max' => 65],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['language_ids', 'string'],
            [['position', 'location', 'site', 'background'], 'string', 'max' => 126],
            [['language_ids', 'notice_ids', 'tagValues'], 'safe'],
            [['imageFile', 'backgroundFile'], 'file', 'extensions' => 'png, jpg'],
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
            'email' => 'Email',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'image' => 'Image',
            'surname' => 'My Last Name',
            'name' => 'My Name',
            'gender_id' => 'My Gender',
            'position' => 'My Position',
            'location' => 'My Location',
            'language_ids' => 'Languages',
            'site' => 'My site',
            'chat_me_able_id' => 'Who can send me a message',
            'invite_project_able_id' => 'Who can add me to a project',
            'notice_ids' => 'Notice',
            'imageFile' => 'My Photo',
            'backgroundFile' => 'Background image',
            'tagValues' => 'Competence',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['field_id' => 'id']);
    }

    public function getOwnTags()
    {
        return $this->getTags()->andOnCondition([Tag::tableName().'.type_id' => Tag::PERSON_TYPE]);
    }

    public function getUsersForProjects()
    {
        return $this->hasMany(BookUserProject::className(), ['user_id' => 'id']);
    }

    public function getAdminsForProjects()
    {
        return $this->hasMany(BookOwnerProject::className(), ['user_id' => 'id']);
    }

    public function getProjects($type = Project::RELATION_PARTICIPANT)
    {
        $viaTable = '';
        switch ($type) {
            case Project::RELATION_PARTICIPANT:
                $viaTable = 'usersForProjects';
                break;
            case Project::RELATION_ADMIN:
                $viaTable = 'adminsForProjects';
                break;
        }

        return $this->hasMany(Project::className(), ['id' => 'project_id'])
            ->via($viaTable)
            ->joinWith(['tags' => function($query) {
                $query->andOnCondition([Tag::tableName().'.type_id' => Tag::PROJECT_TYPE]);
            }], true, 'LEFT OUTER JOIN');
    }

    public function getParticipants()
    {
        return $this->hasMany(BookUserCompany::className(), ['user_id' => 'id']);
    }

    public function getAdmins()
    {
        return $this->hasMany(BookAdminCompany::className(), ['admin_id' => 'id']);
    }

    public function getParticipantsCommunity()
    {
        return $this->hasMany(BookUserCommunity::className(), ['user_id' => 'id']);
    }

    public function getAdminsCommunity()
    {
        return $this->hasMany(BookAdminCommunity::className(), ['admin_id' => 'id']);
    }

    public function getCompanies($type)
    {

        $viaTable = '';
        switch ($type) {
            case Company::ROLE_PARTICIPANT_TYPE:
                $viaTable = 'participants';
                break;
            case Company::ROLE_ADMIN_TYPE:
                $viaTable = 'admins';
                break;
        }

        return $this->hasMany(Company::className(), ['id' => 'company_id'])
            ->via($viaTable);
    }

    public function getCommunities($type)
    {

        $viaTable = '';
        switch ($type) {
            case Community::ROLE_PARTICIPANT_TYPE:
                $viaTable = 'participantsCommunity';
                break;
            case Community::ROLE_ADMIN_TYPE:
                $viaTable = 'adminsCommunity';
                break;
        }

        return $this->hasMany(Community::className(), ['id' => 'community_id'])
            ->via($viaTable);
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

    public function getProjectsData($page = 1, $search = '', $type)
    {

        $query = $this->getProjects($type);
        $query->andFilterWhere(['LIKE', Project::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Project::$limit, 'projects');

    }

    public function getCompaniesData($page = 1, $search = '', $type)
    {
        $query = $this->getCompanies($type);
        $query->andFilterWhere(['LIKE', Company::tableName() . '.name', $search]);
        return Pagination::getData($query, $page, Company::$limit, 'companies');
    }

    public function getCommunitiesData($page = 1, $search = '', $type)
    {
        $query = $this->getCommunities($type);
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

        $this->location = Location::get($this->location);

        $this->full_name = $this->surname . ($this->surname ? ' ' : '') . $this->name;

        $this->setImage('image');
        $this->setImage('background');
        $this->setAsArray('notice_ids');
        $this->setRelation(Yii::$app->user);
    }

    public function setRelation($user)
    {

        if ($this->id === $user->id) {
            $this->relation = self::RELATION_SELF;
        } else {
            $isFollowing = BookFollowers::isFollowingTo($user->id, $this->id);
            $this->relation = $isFollowing ? self::RELATION_FOLLOWING : false;
        }

    }

    public function savePerson()
    {

        $this->saveImage('image');
        $this->saveImage('background');
        $this->saveids('notice_ids');
        Tag::updateAllTags($this->tagValues, $this->id, Tag::PERSON_TYPE);

        Location::setAttribute($this);

    }

    private function saveIds($attr)
    {
        if ($this->$attr && is_array($this->$attr)) {
            $this->$attr = join(',', $this->$attr);
        }
    }

    private function setAsArray($attr)
    {
        if ($this->$attr && !is_array($this->$attr)) {
            $this->$attr = explode(',', $this->$attr);
        }
    }


    private function setImage($type)
    {
        $image = $this->$type;
        $dir = self::$avatar_path . $type . '/';
        $path = Yii::getAlias('@frontend') . '/web' . $dir;
        $isImageExist = file_exists($path . $image);
        $showAttr = $type . 'Show';
        if ($image && $isImageExist) {
            $this->$showAttr = Yii::getAlias('@web') . $dir . $image;
        } else {
            $this->$showAttr = static::$default_avatar;
        }

    }

    public function saveImage($type)
    {
        $attrName = $type.'File';
        $file = UploadedFile::getInstance($this, $attrName);

        if($file && $file->tempName) {
            $this->$attrName = $file;

            if ($this->validate([$attrName])) {
                $dir = Yii::getAlias('@frontend') . '/web' . self::$avatar_path . $type . '/';

                if($this->$type && file_exists($dir . $this->$type))
                {
                    //удаляем файл
                    unlink($dir . $this->$type);
                    $this->$type = '';
                }

                $fileName = OrlandoBanana::getRandomFileName($dir, $file->extension);
                $this->$attrName->saveAs($dir . $fileName);
                $this->$attrName = $fileName; // без этого ошибка

                $image = Image::frame($dir . $fileName);
                $sizes = $image->getSize();

                $width = ($sizes->getWidth() > self::FILE_WIDTH) ? self::FILE_WIDTH : $sizes->getWidth();
                $height = ($sizes->getHeight() > self::FILE_HEIGHT) ? self::FILE_HEIGHT : $sizes->getHeight();

                $sizes->widen($width);
                $sizes->heighten($height);
                $image->resize($sizes)->save($dir . $fileName);

                $this->$type = $fileName;

            }

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
