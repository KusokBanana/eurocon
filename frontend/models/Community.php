<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use frontend\models\books\BookAdminCommunity;
use frontend\models\books\BookUserCommunity;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "community".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $background
 * @property integer $post_ability_id
 * @property integer $acceptance_id
 */
class Community extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community';
    }

    public static $default_image = 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSUQhqwznhnuV08YHOcoGczFwGDMHJ5k2nYxQ6DHTAhmr4JWbJssw';

    private static $image_path = '/upload/community/';
    public static $limit = 12;
    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;
    public $relation = false;

    public $participants = [];
    public $admins = [];

    const ROLE_ADMIN_TYPE = 1;
    const ROLE_PARTICIPANT_TYPE = 2;
    const ROLE_WAITING_FOR_CONFIRM = 3;

    const IMAGE_SIZE = 1024 * 1024 * 40; // 40 MB

    public $tagValues;
    public $imageFile;
    public $imageShow;
    public $backgroundFile;
    public $backgroundShow;

    public static $post_abilities = [
        1 => 'only participants',
        2 => 'participants and friends of participants',
        3 => 'everyone',
    ];

    public static $acceptance = [
        1 => 'with agreement',
        2 => 'without agreement',
    ];

    const JOIN_WITH_AGREEMENT = 1;
    const JOIN_WITHOUT_AGREEMENT = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'post_ability_id', 'acceptance_id'], 'required'],
            [['post_ability_id', 'acceptance_id'], 'integer'],
            [['name', 'image', 'background'], 'string', 'max' => 126],
            ['tagValues', 'safe'],
            [['imageFile', 'backgroundFile'], 'image', 'maxSize' => self::IMAGE_SIZE, 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Community Name',
            'imageFile' => 'Community Photo',
            'tagValues' => 'Tags',
            'backgroundFile' => 'Background Image',
            'post_ability_id' => 'Who can add post',
            'acceptance_id' => 'How to join community',
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['field_id' => 'id']);
    }

    public function getOwnTags()
    {
        return $this->getTags()->andOnCondition([Tag::tableName().'.type_id' => Tag::COMMUNITY_TYPE]);
    }

    public function getPersonsData($type, $extraData = [])
    {

        switch ($type) {
            case self::ROLE_ADMIN_TYPE:
                $query = BookAdminCommunity::getAdmins($this->id, true);
                break;
            case self::ROLE_PARTICIPANT_TYPE:
                $query = BookUserCommunity::getParticipants($this->id, true);
                break;
            default:
                return false;
        }

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData)
            ->setSearchString("CONCAT(" . Person::tableName() . ".`name`, ' ', " .
                Person::tableName() . ".`surname`)")
            ->search()
            ->setData(0, null, $type);

        return $ajaxReload;
    }

    public function createNew()
    {

        $this->saveImage('image');
        $this->saveImage('background');

        if ($this->save()) {
            $newAdmin = new BookAdminCommunity();
            $newAdmin->admin_id = Yii::$app->user->id;
            $newAdmin->community_id = $this->id;

            if ($newAdmin->validate() && $newAdmin->save()) {
                return $this->id;
            }
        }

    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setImage('image');
        $this->setImage('background');

    }

    /**
     * @param $type ('image' OR 'background')
     */
    public function saveImage($type)
    {
        $attrName = $type.'File';
        $file = UploadedFile::getInstance($this, $attrName);

        if($file && $file->tempName) {
            $this->$attrName = $file;

            if ($this->validate([$attrName])) {
                $dir = Yii::getAlias('@frontend') . '/web' . self::$image_path . $type . '/';

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

    protected function setImage($type)
    {

        $image = $this->image;
        $path = Yii::getAlias('@frontend') . '/web' . self::$image_path . $type . '/';
        $isImageExist = file_exists($path . $image);
        $attr = $type . 'Show';
        if ($image && $isImageExist) {
            $this->$attr = Yii::getAlias('@web') . self::$image_path . $type . '/' . $image;
        } else {
            $this->$attr = static::$default_image;
        }

    }

    public function setRelation($user)
    {

        $isAdmin = BookAdminCommunity::findOne(['community_id' => $this->id, 'admin_id' => $user->id]);
        if ($isAdmin) {
            $this->relation = self::ROLE_ADMIN_TYPE;
        } else {
            $isParticipant = BookUserCommunity::findOne(['community_id' => $this->id, 'user_id' => $user->id]);
            if ($isParticipant) {
                $this->relation = $isParticipant->is_confirmed ? self::ROLE_PARTICIPANT_TYPE : self::ROLE_WAITING_FOR_CONFIRM;
            }
        }

    }

    public function join($user_id)
    {
        if ($user_id) {
            $isConfirmed = ($this->acceptance_id == self::JOIN_WITH_AGREEMENT) ? 0 : 1;
            return BookUserCommunity::add($user_id, $this->id, $isConfirmed);
        }

        return false;

    }
    public function leave($user_id)
    {
        if ($user_id) {
            BookUserCommunity::remove($user_id, $this->id);
        }
    }

    public static function getData($user_id, $page = 1, $extraData = [])
    {
        $query = static::find();
        $subQuery1 = BookUserCommunity::find()->select('community_id')->where(['user_id' => $user_id]);
        $subQuery2 = BookAdminCommunity::find()->select('community_id')->where(['admin_id' => $user_id]);
        $search = ArrayHelper::getValue($extraData, 'search', false);

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData);

        if ($user_id && !Person::isQuest($user_id) && !$search) {
            $query->where(['or', ['IN', 'id', $subQuery1], ['IN', 'id', $subQuery2]]);
        }
        if ($search) {
            $ajaxReload->search();
            if ($user_id) {
                // TODO order it here
            }
        }

        $ajaxReload->setData($page, Community::$limit, 'communities');
        return $ajaxReload;
    }

}
