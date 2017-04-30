<?php

namespace frontend\models;

use common\models\OrlandoBanana;
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
 * @property string $image_src
 * @property integer $type
 * @property string $description
 *
 * @property BookCommunityProject[] $bookCompanyProjects
 * @property BookUserCommunity[] $bookUserCompanies
 */
class Community extends ActiveRecord
{

    public static $limit = 12;
    public static $default_avatar = '@web/img/layer_images/company-avatar.png';
    public $image;

    private static $avatar_path = '@web/upload/avatars/community/';
    private static $absolute_avatar_path = '@frontend/web/upload/avatars/community/';
    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;

    const COMMUNITY_ADMIN_TYPE = 1;
    const COMMUNITY_PARTICIPANT_TYPE = 2;

    const IMAGE_SIZE = 1024 * 1024 * 10; // 10 MB

    const COMMUNITY_TYPE_COMPANY = 1;
    const COMMUNITY_TYPE_TEAM = 2;
    const COMMUNITY_TYPE_PUBLIC_PAGE = 3;
    const COMMUNITY_TYPE_ANOTHER = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community';
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
            ['image', 'image', 'maxSize' => self::IMAGE_SIZE, 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name of community',
            'location_id' => 'Location ID',
            'email' => 'Community Email',
            'phone' => 'Community Phone',
            'image' => 'Image',
            'type' => 'Type of community',
            'description' => 'Describe your community',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookCompanyProjects()
    {
        return $this->hasMany(BookCommunityProject::className(), ['community_id' => 'id']);
    }

    public function getParticipants()
    {
        return $this->hasMany(BookUserCommunity::className(), ['community_id' => 'id']);
    }

    public function getAdmins()
    {
        return $this->hasMany(BookAdminsCommunity::className(), ['community_id' => 'id']);
    }

    public function getAdminsOfCommunity()
    {
        return $this->hasMany(Person::className(), ['id' => 'admin_id'])
            ->via('admins');
    }

    public function getParticipantsOfCommunity()
    {
        return $this->hasMany(Person::className(), ['id' => 'user_id'])
            ->via('participants');
    }

    public function getPersonsData($type, $page = 1)
    {

        switch ($type) {
            case self::COMMUNITY_ADMIN_TYPE:
                $query = $this->getAdminsOfCommunity();
                break;
            case self::COMMUNITY_PARTICIPANT_TYPE:
                $query = $this->getParticipantsOfCommunity();
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
                case Community::COMMUNITY_ADMIN_TYPE:
                    $dataArray = $this->admins;
                    break;
                case Community::COMMUNITY_PARTICIPANT_TYPE:
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
            $newAdmin = new BookAdminsCommunity();
            $newAdmin->admin_id = Yii::$app->user->id;
            $newAdmin->community_id = $this->id;

            $this->saveImage();

            if ($newAdmin->validate() && $newAdmin->save()) {
                return $this->id;
            }
        }

    }

    public function join($user_id)
    {

        if ($user_id) {
            $isAdmin = BookAdminsCommunity::find()->where(['admin_id' => $user_id, 'community_id' => $this->id])->one();
            if ($isAdmin)
                return false;

            $newParticipant = new BookUserCommunity();
            $newParticipant->user_id = $user_id;
            $newParticipant->community_id = $this->id;
            if ($newParticipant->save())
                return true;
        }

        return false;

    }

    public function leave($user_id)
    {

        if ($user_id) {
            $participant = BookUserCommunity::find()->where(['user_id' => $user_id, 'community_id' => $this->id])->one();
            if ($participant) {
                $participant->delete();
                return true;
            }
        }

        return false;

    }

    private function saveImage()
    {

        $file = UploadedFile::getInstance($this, 'image');

        if($file) {
            $this->image = $file;

            $dir = Yii::getAlias(self::$absolute_avatar_path);
            $fileName = OrlandoBanana::getRandomFileName($dir, $file->extension);

            $image = Image::frame($file->tempName);
            $sizes = $image->getSize();

            $width = ($sizes->getWidth() > self::FILE_WIDTH) ? self::FILE_WIDTH : $sizes->getWidth();
            $height = ($sizes->getHeight() > self::FILE_HEIGHT) ? self::FILE_HEIGHT : $sizes->getHeight();

            $sizes->widen($width);
            $sizes->heighten($height);
            $image->resize($sizes)->save($dir . $fileName);

            $this->image_src = $fileName;
            $this->save();
        }

    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setImage();

    }

    private function setImage()
    {

        $image = $this->image_src;
        $path = Yii::getAlias(self::$absolute_avatar_path);
        $isImageExist = file_exists($path . $image);
        if ($image && $isImageExist) {
            $this->image = Yii::getAlias(self::$avatar_path) . $image;
        } else {
            $this->image = static::$default_avatar;
        }

    }

}
