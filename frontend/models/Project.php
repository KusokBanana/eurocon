<?php

namespace frontend\models;

use frontend\models\books\BookCompanyProject;
use frontend\models\books\BookOwnerProject;
use frontend\models\books\BookUserProject;
use Imagine\Image\Box;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

use yii\imagine\Image;
/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $image
 * @property string $description
 * @property integer $type_id
 * @property integer $status_id
 * @property integer $budget_id
 * @property integer $category_id
 * @property integer $editability_id
 * @property string $project_links
 * @property string $background [varchar(126)]
 * @property string $completion_date [date]
 * @property string $social_links
 *
 * @property BookCompanyProject[] $bookCompanyProjects
 * @property BookUserProject[] $participants
 */
class Project extends ActiveRecord
{

    private static $image_path = '/upload/project/';
    private static $default_image_path = 'http://cdn.homedsgn.com/wp-content/uploads/2014/01/A-Country-Home-in-Brazil-17.jpg';

    public $participants;
    public $tagValues;
    public $owners;
    public $imageFile;
    public $backgroundFile;
    public $imageShow;
    public $backgroundShow;
    public $statusData;

    const RELATION_ADMIN = 1;
    const RELATION_PARTICIPANT = 2;

    public $relation = false;

    public static $limit = 12;

    public static $types = [
        1 => 'New building',
        2 => 'Renovation',
        3 => 'Extension',
    ];

    public static $statuses = [
        1 => 'Planning',
        2 => 'Confirmed',
        3 => 'Under Construction',
        4 => 'Ready',
    ];

    public static $budgets = [
        1 => '[ 0; 1 mln $ ]',
        2 => '[ 1 mln $; 3 mln $ ]',
        3 => '[ 3 mln $; 5 mln $ ]',
        4 => '[ 5 mln $; 10 mln $ ]',
        5 => ' >10 mln $ ',
    ];

    public static $categories = [
        1 => 'Private / Farms',
        2 => 'Residential',
        3 => 'Hotel',
        4 => 'Restaurant',
        5 => 'Shop',
        6 => 'Office',
        7 => 'Logistic',
        8 => 'Industry',
        9 => 'Health and Medicine',
        10 => 'Retirement residentials',
        11 => 'Schools and Universities',
        12 => 'Culture',
        13 => 'Sport',
        14 => 'Sacral',
        15 => 'Goverment',
        16 => 'rports and Railway stations',
        17 => 'Energetics',
        18 => 'Infrastructure',
        19 => 'Landscape',
        20 => 'Other',
    ];

    public static $editability = [
        1 => 'Everyone',
        2 => 'Only your friends',
        3 => 'Only you',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status_id', 'editability_id'], 'required'],
            [['date', 'completion_date'], 'date', 'format' => 'yyyy-MM-dd'],
            ['date', 'default', 'value' => date('Y-m-d')],
            [['description'], 'string'],
            [['type_id', 'status_id', 'budget_id', 'category_id', 'editability_id'], 'integer'],
            [['name', 'image', 'background'], 'string', 'max' => 126],
            [['project_links'], 'string', 'max' => 255],
            [['participants', 'owners', 'tagValues', 'social_links'], 'safe'],
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
            'name' => 'Project Name',
            'date' => 'Date',
            'participants' => 'Participants',
            'description' => 'Description',
            'image' => 'Photo',
            'type_id' => 'Project Type',
            'status_id' => 'Project Status',
            'budget_id' => 'Budget',
            'category_id' => 'Project Category',
            'editability_id' => 'Who can edit your project?',
            'owners' => 'Project Partners and Owners',
            'tagValues' => 'Add tags for your project',
            'project_links' => 'Project Links',
            'background' => 'Background',
            'social_links' => 'Social',
            'completion_date ' => 'Completion Date ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyProjects()
    {
        return $this->hasMany(BookCompanyProject::className(), ['project_id' => 'id']);
    }

    public function getProjects()
    {
        return $this->hasMany(BookUserProject::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Person::className(), ['id' => 'user_id'])
            ->via('projects');
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['field_id' => 'id']);
    }

    public function getOwnTags()
    {
        return $this->getTags()->andOnCondition([Tag::tableName().'.type_id' => Tag::PROJECT_TYPE]);
    }

    public function getParticipantsData($page = 1, $search = '')
    {

        $query = $this->getParticipants()->joinWith(['tags' => function($query) {
            $query->andOnCondition(['type_id' => Tag::PERSON_TYPE]); // TODO changed from project type
        }], true, 'LEFT OUTER JOIN');

        $query->andFilterWhere(['LIKE', 'CONCAT(IFNULL(surname, ""), " ", IFNULL(name, ""))', $search]);

        return Pagination::getData($query, $page, Person::$limit, 'participants');
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->social_links = ($this->social_links) ? json_decode($this->social_links, true) : [];

        $this->setStatusData();
        $this->setImage('image');
        $this->setImage('background');

    }

    private function setImage($type)
    {
        $image = $this->$type;
        $dir = self::$image_path . $type . '/';
        $path = Yii::getAlias('@frontend') . '/web' . $dir;
        $isImageExist = file_exists($path . $image);
        $showAttr = $type . 'Show';
        if ($image && $isImageExist) {
            $this->$showAttr = Yii::getAlias('@web') . $dir . $image;
        } else {
            $this->$showAttr = static::$default_image_path;
        }

    }

    public function createNew()
    {
        if ($this->validate() && $this->save()) {

            if ($this->id) {
                Tag::newTagsFromString($this->tagValues, $this->id, Tag::PROJECT_TYPE);
                BookOwnerProject::addNew(Yii::$app->user->id, $this->id);
                $this->addNewUsers();
            }

        }
    }

    public function updateProject()
    {

        $this->social_links = json_encode($this->social_links);
        $file = UploadedFile::getInstance($this, 'imageFile');
        $this->saveImage($file, 'image');
        $file = UploadedFile::getInstance($this, 'background_imageFile');
        $this->saveImage($file, 'background_image');

        $this->save();
        $this->addNewUsers();
        Tag::updateAllTags($this->tagValues, $this->id, Tag::PROJECT_TYPE);

    }

    private function addNewUsers()
    {
        if ($this->participants && !empty($this->participants)) {
            foreach ($this->participants as $participant) {
                if ($participant) {
                    BookUserProject::addNew($participant, $this->id);
                }
            }
        }
        if ($this->owners && !empty($this->owners)) {
            foreach ($this->owners as $owner) {
                if ($owner) {
                    BookOwnerProject::addNew($owner, $this->id);
                }
            }
        }
    }

    public function setRelation($user)
    {

        $isAdmin = BookOwnerProject::findOne(['project_id' => $this->id, 'user_id' => $user->id]);
        if ($isAdmin) {
            $this->relation = self::RELATION_ADMIN;
        } else {
            $isParticipant = BookUserProject::findOne(['project_id' => $this->id, 'user_id' => $user->id]);
            if ($isParticipant)
                $this->relation = self::RELATION_PARTICIPANT;
        }

    }

    public function beforeSave($insert)
    {

        $this->project_links = str_replace(' ', '', $this->project_links);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function saveImage($file, $type)
    {

        if ($file && $file->tempName) {
            $attrName = $type.'File';
            $this->$attrName = $file;
            if ($this->validate([$attrName])) {
                $dir = Yii::getAlias('@frontend') . '/web' . self::$image_path . $type . '/';

                if($this->$type && file_exists($dir . $this->$type))
                {
                    //удаляем файл
                    unlink($dir . $this->$type);
                    $this->$type = '';
                }

                $fileName = time() . '.' . $this->$attrName->extension;
                $this->$attrName->saveAs($dir . $fileName);
                $this->$attrName = $fileName; // без этого ошибка
                $this->$type = $fileName;
// Для ресайза фотки до 800x800px по большей стороне надо обращаться к функции Box() или widen, так как в обертках доступны только 5 простых функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
                $photo = Image::getImagine()->open($dir . $fileName);
                $photo->thumbnail(new Box(800, 800))->save($dir . $fileName, ['quality' => 90]);
                //$imagineObj = new Imagine();
                //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
            }
        }

    }

    public function setStatusData()
    {

        $statusesIcons = [
            1 => '',
            2 => '',
            3 => '',
            4 => '<i class="icon wb-check" aria-hidden="true"></i>'
        ];

        $statusId = $this->status_id;
        $name = isset(self::$statuses[$statusId]) ? self::$statuses[$statusId] : '-';
        $icon = isset($statusesIcons[$statusId]) ? $statusesIcons[$statusId] : '';

        $statusData = [
            'name' => $name,
            'icon' => $icon
        ];

        $this->statusData = $statusData;
    }

}
