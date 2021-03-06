<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use frontend\models\books\BookAdminCompany;
use frontend\models\books\BookCompanyProject;
use frontend\models\books\BookFollowers;
use frontend\models\books\BookUserCompany;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $image
 * @property integer $type
 * @property string $description
 * @property string $specialty [varchar(126)]
 * @property string $location [varchar(255)]
 * @property string $site [varchar(126)]
 * @property string $job_types [varchar(255)]
 * @property string $birthday [date]
 * @property int $chat_me_able_id [int(11)]
 * @property int $invite_project_able_id [int(11)]
 *
 * @property BookCompanyProject[] $bookCompanyProjects
 * @property BookUserCompany[] $bookUserCompanies
 */
class Company extends Community
{

    public static $limit = 12;
    public static $default_image = '@web/img/layer_images/company-avatar.png';

    public static $image_path = '/upload/company/image/';

    const COMMUNITY_TYPE_COMPANY = 1;
    const COMMUNITY_TYPE_TEAM = 2;
    const COMMUNITY_TYPE_PUBLIC_PAGE = 3;
    const COMMUNITY_TYPE_ANOTHER = 4;

    public $search_type_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['name', 'email'], 'string', 'max' => 126],
            [['phone'], 'string', 'max' => 65],
            ['imageFile', 'image', 'maxSize' => self::IMAGE_SIZE, 'extensions' => 'png, jpg, gif'],
            [['name'], 'required'],
            ['type', 'default', 'value' => 1],
            ['invite_project_able_id', 'default', 'value' => 1],
            ['chat_me_able_id', 'default', 'value' => 1],
            [['type', 'chat_me_able_id', 'invite_project_able_id'], 'integer'],
            [['birthday', 'tagValues', 'participants', 'admins'], 'safe'],
            [['name', 'email', 'specialty', 'site', 'background'], 'string', 'max' => 126],
            [['phone', 'image'], 'string', 'max' => 65],
            [['location', 'job_types'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Company Name',
            'location' => 'Location',
            'email' => 'Company Email',
            'phone' => 'Company Phone',
            'image' => 'Company Photo',
            'type' => 'Type of company',
            'description' => 'Describe your company',
            'specialty' => 'Specialty',
            'site' => 'Company site',
            'background' => 'Background Image',
            'job_types' => 'Types of jobs',
            'birthday' => 'Company Foundation',
            'chat_me_able_id' => 'Who can send company a message',
            'invite_project_able_id' => 'Who can add company to a project',
            'tagValues' => 'Types of jobs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCompanyProjects()
    {
        return $this->hasMany(BookCompanyProject::className(), ['company_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['field_id' => 'id']);
    }

    public function getOwnTags()
    {
        return $this->getTags()->andOnCondition([Tag::tableName().'.type_id' => Tag::COMPANY_TYPE]);
    }

    public function getPersonsData($type, $page = 1, $extraData = [])
    {

        switch ($type) {
            case self::ROLE_ADMIN_TYPE:
                $query = BookAdminCompany::getAdmins($this->id, true);
                break;
            case self::ROLE_PARTICIPANT_TYPE:
                $query = BookUserCompany::getParticipants($this->id, true);
                break;
            default:
                return false;
        }

        $limit = ($page === false) ? null : 6;

        $extraData = (empty($extraData)) ? ['id' => $this->id] : $extraData;

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData, Person::class)
            ->setData($page, $limit, $type);

        return $ajaxReload;
    }

    public function getProjectsData($page = 1, $extraData = [])
    {
        $query = BookCompanyProject::getProjects($this->id, true);

        $limit = ($page === false) ? null : 9;
        $extraData = (empty($extraData)) ? ['id' => $this->id] : $extraData;

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData, Project::class)
            ->setFilters()
            ->setData($page, $limit, 'projects');

        return $ajaxReload;
    }

    public function createNew()
    {

        Location::setAttribute($this);
        $this->saveImage('image');
        $this->validate();
        if ($this->save()) {
            BookAdminCompany::addNew(Person::get()->id, $this->id);
            return $this->id;
        }

    }

    public function join($user_id)
    {
// TODO добавить сюда в зависимости от выбранной настройки вступления в компанию разное добавление пользователя
        if ($user_id) {
            $isAdmin = BookAdminCompany::find()->where(['admin_id' => $user_id, 'company_id' => $this->id])->one();
            if ($isAdmin)
                return false;

            $newParticipant = new BookUserCompany();
            $newParticipant->user_id = $user_id;
            $newParticipant->company_id = $this->id;
            if ($newParticipant->save())
                return true;
        }

        return false;

    }

    public function leave($user_id)
    {

        if ($user_id) {
            $participant = BookUserCompany::find()->where(['user_id' => $user_id, 'company_id' => $this->id])->one();
            if ($participant) {
                $participant->delete();
                return true;
            }
        }

        return false;

    }

    public function updateCompany()
    {

        $post = Yii::$app->request->post('Company');
        if (isset($post['birthday']))
            $this->birthday = date('Y-m-d', strtotime($post['birthday']));

        $this->saveImage('image');
        $this->saveImage('background');
        Location::setAttribute($this);
        Tag::updateAllTags($this->tagValues, $this->id, Tag::COMPANY_TYPE);

        $this->save();
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setImage('image');
        $this->setImage('background');

        $this->location = Location::get($this->location);


    }

    public function getPotentialSubscribers()
    {
        $user = Yii::$app->user;
        $potentialSubscribers = ['admins' => [], 'cooperation' => []];
        if ($this->relation == Company::ROLE_ADMIN_TYPE) {
            $follows = BookFollowers::getFollows($user->id, 1, [], true)->data;

            $data = $this->getPersonsData(Company::ROLE_PARTICIPANT_TYPE, false)->data;
            $participantsArray = ArrayHelper::getColumn($data, 'user_id');

            $data = $this->getPersonsData(Company::ROLE_ADMIN_TYPE, false)->data;
            $adminsArray = ArrayHelper::getColumn($data, 'admin_id');

            foreach ($follows as $follow) {
                $isInAdminArr = ArrayHelper::isIn($follow->id, $adminsArray);
                $isInCoopArr = ArrayHelper::isIn($follow->id, $participantsArray);

                if (!$isInAdminArr)
                    $potentialSubscribers['admins'][$follow->id] = $follow->full_name;

                if (!$isInAdminArr && !$isInCoopArr)
                    $potentialSubscribers['cooperation'][$follow->id] = $follow->full_name;
            }
        }

        return $potentialSubscribers;
    }

    public function addNewUsers()
    {
        if ($this->participants && !empty($this->participants)) {
            foreach ($this->participants as $participant) {
                if ($participant) {
                    BookUserCompany::addNew($participant, $this->id);
                }
            }
        }
        if ($this->admins && !empty($this->admins)) {
            foreach ($this->admins as $admin) {
                if ($admin) {
                    BookAdminCompany::addNew($admin, $this->id);
                }
            }
        }
    }

    public function setRelation($user)
    {

        $isAdmin = BookAdminCompany::findOne(['company_id' => $this->id, 'admin_id' => $user->id]);
        if ($isAdmin) {
            $this->relation = self::ROLE_ADMIN_TYPE;
        } else {
            $isParticipant = BookUserCompany::findOne(['company_id' => $this->id, 'user_id' => $user->id]);
            if ($isParticipant)
                $this->relation = self::ROLE_PARTICIPANT_TYPE;
        }
// TODO check if user can send message to company on company page
    }

    public static function getData($user_id, $page = 1, $extraData = [])
    {
        $query = static::find();
        $subQuery1 = BookUserCompany::find()->select('company_id')->where(['user_id' => $user_id]);
        $subQuery2 = BookAdminCompany::find()->select('company_id')->where(['admin_id' => $user_id]);
        $search = ArrayHelper::getValue($extraData, 'search', false);

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData);

        if ($user_id && !Person::isQuest($user_id) && !$search) {
            $query->where(['or', ['IN', 'id', $subQuery1], ['IN', 'id', $subQuery2]]);
        }
        if ($search) {
            $ajaxReload->search();
            if ($user_id) {
                $companiesList = join(',', ArrayHelper::merge(
                    ArrayHelper::getColumn($subQuery1->asArray()->all(), 'company_id'),
                    ArrayHelper::getColumn($subQuery2->asArray()->all(), 'company_id')));

                $select = ($companiesList) ? 'IF(id IN ('.$companiesList.'), 0, 1)' : 'IF(1, 1, 0)';
                $query->addSelect(['*', 'search_type_id' => $select])
                    ->orderBy(['search_type_id' => SORT_ASC]);
            }
        }

        $ajaxReload->setData($page, Company::$limit, 'companies');
        return $ajaxReload;
    }


}
