<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use frontend\models\books\BookAdminCompany;
use frontend\models\books\BookCompanyProject;
use frontend\models\books\BookUserCompany;
use Imagine\Image\BoxInterface;
use Imagine\Image\ImageInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property integer $location_id
 * @property string $email
 * @property string $phone
 * @property string $image
 * @property integer $type
 * @property string $description
 *
 * @property BookCompanyProject[] $bookCompanyProjects
 * @property BookUserCompany[] $bookUserCompanies
 */
class Company extends Community
{

    public static $limit = 12;
    public static $default_image = '@web/img/layer_images/company-avatar.png';

    public static $image_path = '/upload/company/image/';

    public $imageFile;

    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;

    const COMMUNITY_TYPE_COMPANY = 1;
    const COMMUNITY_TYPE_TEAM = 2;
    const COMMUNITY_TYPE_PUBLIC_PAGE = 3;
    const COMMUNITY_TYPE_ANOTHER = 4;

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
            [['name', 'type', 'email'], 'required'],
            [['location_id', 'type'], 'integer'],
            [['description'], 'string'],
            [['name', 'email'], 'string', 'max' => 126],
            [['phone', 'image_src'], 'string', 'max' => 65],
            ['imageFile', 'image', 'maxSize' => self::IMAGE_SIZE, 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name of company',
            'location_id' => 'Location ID',
            'email' => 'Company Email',
            'phone' => 'Company Phone',
            'image' => 'Image',
            'type' => 'Type of company',
            'description' => 'Describe your company',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCompanyProjects()
    {
        return $this->hasMany(BookCompanyProject::className(), ['company_id' => 'id']);
    }

    public function getParticipants()
    {
        return $this->hasMany(BookUserCompany::className(), ['company_id' => 'id']);
    }

    public function getAdmins()
    {
        return $this->hasMany(BookAdminCompany::className(), ['company_id' => 'id']);
    }

    public function getAdminsOfCompany()
    {
        return $this->hasMany(Person::className(), ['id' => 'admin_id'])
            ->via('admins');
    }

    public function getParticipantsOfCompany()
    {
        return $this->hasMany(Person::className(), ['id' => 'user_id'])
            ->via('participants');
    }

    public function getPersonsData($type, $page = 1)
    {

        switch ($type) {
            case self::ROLE_ADMIN_TYPE:
                $query = $this->getAdminsOfCompany();
                break;
            case self::ROLE_PARTICIPANT_TYPE:
                $query = $this->getParticipantsOfCompany();
                break;
            default:
                return false;
        }

        return Pagination::getData($query, $page, 6, $type);
    }

    public function isPerson($type, $dataArray = [])
    {
        if (empty($dataArray)) {
            switch ($type) {
                case Company::ROLE_ADMIN_TYPE:
                    $dataArray = $this->admins;
                    break;
                case Company::ROLE_PARTICIPANT_TYPE:
                    $dataArray = $this->participants;
                    break;
                default:
                    return null;
            }
        }

        $ids = ArrayHelper::getColumn($dataArray, function ($element) {
            return $element->id;
        });

        $personId = Yii::$app->user->id;
        return in_array($personId, $ids);
    }

    public function createNew()
    {

        if ($this->save()) {
            $newAdmin = new BookAdminCompany();
            $newAdmin->admin_id = Yii::$app->user->id;
            $newAdmin->company_id = $this->id;

            $this->saveImage('image');

            if ($newAdmin->validate() && $newAdmin->save()) {
                return $this->id;
            }
        }

    }

    public function join($user_id)
    {

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

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setImage('image');

    }

}
