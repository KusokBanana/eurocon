<?php

namespace frontend\models;

use common\models\OrlandoBanana;
use Imagine\Image\Box;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\imagine\Image;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $text
 * @property integer $type_for
 * @property integer $field_id
 * @property string $images
 */
class Post extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    const TYPE_PROJECT = 1;
    const TYPE_COMPANY = 2;
    const IMAGE_WIDTH = 220;
    const IMAGE_HEIGHT = 220;

    public static $PROJECT_IMAGE_PATH = '/upload/project/post/';

    public $commentaries = [];
    public $commentsCount = 0;
    public $image_files;
    public $image_file;
    public $image_srcs = [];

    public static $limit = 10;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'type_for', 'field_id'], 'required'],
            [['date'], 'datetime'],
            [['date'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['text'], 'string'],
            ['image_files', 'file', 'extensions' => 'png, jpg', 'maxFiles' => 3],
            ['image_file', 'file', 'extensions' => 'png, jpg'],
            [['type_for', 'field_id'], 'integer'],
            [['title', 'images'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'title' => 'Post title',
            'text' => 'Post text',
            'type_for' => 'Type For',
            'field_id' => 'Field ID',
            'image_files' => 'Image Files',
            'images' => 'Images',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id'])
            ->orderBy(['id' => SORT_DESC])
            ->joinWith('user');
    }

    public static function getPostsData($type, $field_id, $page = 1, $search = '')
    {

        if ($type && $field_id) {

            $query = static::getPosts($type, $field_id);

            $query->andFilterWhere(['LIKE', 'title', $search]);

            $result = Pagination::getData($query, $page, static::$limit, 'forum');

            /** @var Post $post */
            foreach ($result['data'] as $post) {
                $post->setCommentaries();
            }

            return $result;

        }

    }

    public static function getPosts($type, $field_id, $isOne = false, $isQuery = true, $isWithComments = false)
    {

        $query = static::find()->where(['type_for' => $type, 'field_id' => $field_id])
            ->orderBy(['date' => SORT_DESC]);

        if ($isWithComments)
            $query->joinWith('comments');

        if (!$isQuery) {
            if ($isOne)
                $query->one();
            else
                $query->all();
        }

        return $query;

    }

    public function setCommentaries()
    {
        if (!empty($this->comments)) {
            /** @var PostComment $comment */
            foreach ($this->comments as $comment) {
                $replyFor = is_null($comment->reply_comment_id) ? 0 : $comment->reply_comment_id;
                $this->commentaries[$replyFor][$comment->id] = $comment;
                ksort($this->commentaries[$replyFor]);
            }
            ksort($this->commentaries);
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $count = PostComment::find()->where(['post_id' => $this->id, 'reply_comment_id' => NULL])->count();
        $this->commentsCount = $count;
        $this->setImages();

    }


    public function saveImages($files)
    {

        if ($files && !empty($files)) {

            $filesNames = [];
            foreach ($files as $oneFile) {
                if ($oneFile && $oneFile->tempName) {
                    $this->image_file = $oneFile;
                    if ($this->validate(['image_file'])) {
                        $dir = Yii::getAlias('@frontend') . '/web' . self::$PROJECT_IMAGE_PATH;

                        $this->deleteIfExist($dir);

                        $fileName = OrlandoBanana::getRandomFileName($dir, $oneFile->extension);
                        $this->image_file->saveAs($dir . $fileName);
                        $this->image_file = $fileName; // без этого ошибка
//
//                        $image = Image::frame($dir . $fileName);
//                        $sizes = $image->getSize();
//
//                        $width = ($sizes->getWidth() > self::IMAGE_WIDTH) ? self::IMAGE_WIDTH : $sizes->getWidth();
//                        $height = ($sizes->getHeight() > self::IMAGE_HEIGHT) ? self::IMAGE_HEIGHT : $sizes->getHeight();
//
//                        $sizes->widen($width);
//                        $sizes->heighten($height);
//                        $image->resize($sizes)->save($dir . $fileName);

                        $photo = Image::getImagine()->open($dir . $fileName);
                        $photo->thumbnail(new Box(self::IMAGE_WIDTH, self::IMAGE_HEIGHT))
                            ->save($dir . $fileName, ['quality' => 90]);

                        $filesNames[] = $fileName;
                    }
                }
            }

            $this->image_files = ''; // без этого ошибка
            if (!empty($filesNames))
                $this->images = join(',', $filesNames);

        }
    }

    private function setImages()
    {
        if ($this->images) {
            $names = explode(',', $this->images);
            foreach ($names as $name) {
                $path = Yii::getAlias('@frontend') . '/web' . self::$PROJECT_IMAGE_PATH;
                $isFileExist = file_exists($path . $name);
                if ($name && $isFileExist) {
                    $this->image_srcs[] = Yii::getAlias('@web') . self::$PROJECT_IMAGE_PATH . $name;
                }
            }

        }
    }

    private function deleteIfExist($dir)
    {
        if($this->images) {
            $imageSrcs = explode(',', $this->images);
            foreach ($imageSrcs as $imageSrc) {
                if (file_exists($dir . $imageSrc)) {
                    //удаляем файл
                    unlink($dir . $imageSrc);
                }
            }
            $this->images = '';
        }
    }

}
