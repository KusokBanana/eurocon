<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use frontend\models\books\BookAdminCommunity;
use frontend\models\books\BookUserCommunity;
use Yii;
use yii\db\ActiveRecord;
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

    public static $default_image = '@web/img/layer_images/company-avatar.png';
    private static $image_path = '/upload/community/';
    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;
    public $relation = false;

    const ROLE_ADMIN_TYPE = 1;
    const ROLE_PARTICIPANT_TYPE = 2;

    const IMAGE_SIZE = 1024 * 1024 * 40; // 40 MB

    public $tagValues;
    public $imageFile;
    public $backgroundFile;
    public $image_show;

    public static $post_abilities = [
        1 => 'only participants',
        2 => 'participants and friends of participants',
        3 => 'everyone',
    ];

    public static $acceptance = [
        1 => 'with agreement',
        2 => 'without agreement',
    ];

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

// Для ресайза фотки до 800x800px по большей стороне надо обращаться к функции Box() или widen, так как в обертках доступны только 5 простых функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
//                $photo = Image::getImagine()->open($dir . $fileName);
//                $photo->thumbnail(new Box(800, 800))->save($dir . $fileName, ['quality' => 90]);

                //$imagineObj = new Imagine();
                //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
            }

        }

    }

    protected function setImage($type)
    {

        $image = $this->image;
        $path = Yii::getAlias('@frontend') . '/web' . self::$image_path . $type . '/';
        $isImageExist = file_exists($path . $image);
        $attr = $type . 'File';
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
            if ($isParticipant)
                $this->relation = self::ROLE_PARTICIPANT_TYPE;
        }

    }

}
