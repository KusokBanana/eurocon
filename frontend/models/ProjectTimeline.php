<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use Imagine\Image\Box;
use yii\imagine\Image;

/**
 * This is the model class for table "project_timeline".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $text
 * @property integer $media_type_id
 * @property string $media_src
 * @property string $date [date]
 * @property string $title [varchar(255)]
 * @property bool $is_active [tinyint(1)]
 */
class ProjectTimeline extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_timeline';
    }

    private static $image_dir = '/upload/project/timeline/image/';
    private static $video_dir = '/upload/project/timeline/video/';

    const MEDIA_TYPE_IMAGE = 1;
    const MEDIA_TYPE_VIDEO = 2;

    public $image_files;
    public $image_file;
    public $video;
    public $image_srcs = [];
    public $video_src = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'media_type_id'], 'integer'],
            [['text', 'media_src', 'title'], 'string'],
            ['is_active', 'boolean'],
            ['date', 'date', 'format' => 'yyyy-MM-dd'],
            ['image_files', 'file', 'extensions' => 'png, jpg', 'maxFiles' => 5],
            ['image_file', 'file', 'extensions' => 'png, jpg'],
            ['video', 'file', 'extensions' => 'flv ,mov, mp4', 'maxFiles' => 1/*, 'maxSize' => 4096000*/],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'text' => 'Text',
            'media_type_id' => 'Media Type',
            'media_src' => 'Media',
            'video' => 'Video File',
            'image_files' => 'Image Files',
            'title' => 'Title',
        ];
    }

    public function beforeSave($insert)
    {

        if ($insert) {
            $this->date = date('Y-m-d');
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setMedia();

    }

    private function setMedia()
    {
        if ($this->media_src) {
            if ($this->media_type_id == self::MEDIA_TYPE_IMAGE) {
                $names = explode(',', $this->media_src);
                foreach ($names as $name) {
                    $path = Yii::getAlias('@frontend') . '/web' . self::$image_dir;
                    $isFileExist = file_exists($path . $name);
                    if ($name && $isFileExist) {
                        $this->image_srcs[] = Yii::getAlias('@web') . self::$image_dir . $name;
                    }
                }
            } elseif ($this->media_type_id == self::MEDIA_TYPE_VIDEO) {
                $path = Yii::getAlias('@frontend') . '/web' . self::$video_dir;
                $isFileExist = file_exists($path . $this->media_src);
                if ($isFileExist) {
                    $this->video_src = Yii::getAlias('@web') . self::$video_dir . $this->media_src;
                }
            }

        }
    }

    public function saveFile($file)
    {

        if ($this->media_type_id == self::MEDIA_TYPE_IMAGE) {
            $files = $file;
            if ($files && !empty($files)) {

                $filesNames = [];
                foreach ($files as $oneFile) {
                    if ($oneFile && $oneFile->tempName) {
                        $this->image_file = $oneFile;
                        if ($this->validate(['image_file'])) {
                            $dir = Yii::getAlias('@frontend') . '/web' . self::$image_dir;

                            $this->deleteIfExist($dir);

                            $fileName = time() . '.' . $oneFile->extension;
                            $this->image_file->saveAs($dir . $fileName);
                            $this->image_file = $fileName; // без этого ошибка
                            $filesNames[] = $fileName;
// Для ресайза фотки до 800x800px по большей стороне надо обращаться к функции Box() или widen, так как в обертках доступны только 5 простых функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
                            $photo = Image::getImagine()->open($dir . $fileName);
                            $photo->thumbnail(new Box(360, 800))->save($dir . $fileName, ['quality' => 90]);
                            //$imagineObj = new Imagine();
                            //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                            //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
                        }
                    }
                }

                $this->image_files = ''; // без этого ошибка
                if (!empty($filesNames))
                    $this->media_src = join(',', $filesNames);

            }
        } elseif ($this->media_type_id == self::MEDIA_TYPE_VIDEO) {
            if ($file && $file->tempName) {
                $this->video = $file;
                if ($this->validate(['video'])) {
                    $dir = Yii::getAlias('@frontend') . '/web' . self::$video_dir;
                    $this->deleteIfExist($dir);
                    $fileName = time() . '.' . $file->extension;
                    $this->video->saveAs($dir . $fileName);
                    $this->media_src = $fileName;
                    $this->video = '';

                }
            }
        }


    }

    private function deleteIfExist($dir)
    {
        if($this->media_src) {
            $mediaSrcs = explode(',', $this->media_src);
            foreach ($mediaSrcs as $mediaSrc) {
                if (file_exists($dir . $mediaSrc)) {
                    //удаляем файл
                    unlink($dir . $mediaSrc);
                }
            }
            $this->media_src = '';
        }
    }

}
