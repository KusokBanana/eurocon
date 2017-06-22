<?php

namespace frontend\models;

use frontend\models\books\BookMarketplace;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "marketplace_item".
 *
 * @property integer $id
 * @property integer $item_type_id
 * @property integer $type_id
 * @property integer $status_id
 * @property integer $budget_id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $date
 * @property int $owner_id [int(11)]
 */
class MarketplaceItem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketplace_item';
    }


    public static $default_image = '@web/img/portraits/placeholder.png';
    public static $image_path = '/upload/marketplace/';
    public static $limit = 12;

    const FILE_WIDTH = 500;
    const FILE_HEIGHT = 300;
    public $relation = false;

    const IMAGE_SIZE = 1024 * 1024 * 40; // 40 MB
    public $imageFile;
    public $imageShow;

    const RELATION_ADMIN = 1;
    const RELATION_PARTICIPANT = 2;

    public static $types = [
        0 => '-- Not selected --',
        1 => 'New building',
        2 => 'Renovation',
        3 => 'Extension',
    ];

    public static $statuses = [
        0 => '-- Not selected --',
        1 => 'Planning',
        2 => 'Confirmed',
        3 => 'Under Construction',
        4 => 'Ready',
    ];

    public static $budgets = [
        0 => '-- Not selected --',
        1 => '[ 0; 1 mln $ ]',
        2 => '[ 1 mln $; 3 mln $ ]',
        3 => '[ 3 mln $; 5 mln $ ]',
        4 => '[ 5 mln $; 10 mln $ ]',
        5 => ' >10 mln $ ',
    ];

    public static $categories = [
        0 => '-- Not selected --',
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
        0 => '-- Not selected --',
        1 => 'Everyone',
        2 => 'Only your friends',
        3 => 'Only you',
    ];

    const ITEM_TYPE_OFFER = 1;
    const ITEM_TYPE_REQUEST = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['item_type_id', 'type_id', 'status_id', 'budget_id', 'category_id'], 'integer'],
            ['item_type_id', 'default', 'value' => 1], // TODO is this attr need??
            [['description'], 'string'],
            [['owner_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 126],
            [['date'], 'date'],
            [['date'], 'default', 'value' => date('Y-m-d')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_type_id' => 'Item Type ID',
            'type_id' => 'Type ID',
            'status_id' => 'Status ID',
            'budget_id' => 'Budget ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'date' => 'Date',
        ];
    }

    public static function getData($field_id, $type_for, $page = 1, $extraData = [])
    {

        $query = BookMarketplace::get($field_id, $type_for);
        $extraData = (empty($extraData)) ? ['id' => $field_id] : $extraData;

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData, self::class)
                    ->setFilters()
                    ->setData($page, self::$limit, 'marketplace');

        return $ajaxReload;

    }

    public static function getAll($page = 1, $extraData = [])
    {

        $query = static::find();
        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData)
            ->setFilters()
            ->setData($page, self::$limit, 'marketplace');

        return $ajaxReload;

    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        $this->setRelation();
        $this->setImage();
    }

    private function setImage()
    {

        $image = $this->image;
        $path = Yii::getAlias('@frontend') . '/web' . self::$image_path . '/';
        $isImageExist = file_exists($path . $image);
        if ($image && $isImageExist) {
            $this->imageShow = Yii::getAlias('@web') . self::$image_path . '/' . $image;
        } else {
            $this->imageShow = static::$default_image;
        }

    }

    public function setRelation($user = null)
    {

        $user = ($user == null) ? Person::get() : $user;

        $isAdmin = ($this->owner_id == $user->id);
        if ($isAdmin) {
            $this->relation = self::RELATION_ADMIN;
        } else {
            $isParticipant = BookMarketplace::findOne(
                ['field_id' => $user->id, 'type_id' => BookMarketplace::TYPE_FOR_PERSON, 'item_id' => $this->id]
            );
            if ($isParticipant)
                $this->relation = self::RELATION_PARTICIPANT;
        }

    }

    public function follow($user_id)
    {
        if ($user_id && $this->owner_id !== $user_id) {
            return BookMarketplace::add($user_id, $this->id, BookMarketplace::TYPE_FOR_PERSON);
        }
        return false;
    }

    public function leave($user_id)
    {
        if ($user_id) {
            BookMarketplace::remove($user_id, $this->id, BookMarketplace::TYPE_FOR_PERSON);
        }
    }

    public function getProjectsData($page = 1, $extraData = [])
    {
        $subQuery = BookMarketplace::find()
            ->where(['type_id' => BookMarketplace::TYPE_FOR_PROJECT, 'item_id' => $this->id])
            ->select('field_id');

        $query = Project::find()->where(['IN', 'id', $subQuery]);

        $limit = ($page === false) ? null : 9;

        $ajaxReload = new AjaxReload();
        $ajaxReload->init($query, $extraData, Project::class)
            ->setFilters()
            ->setData($page, $limit, 'projects');

        return $ajaxReload;
    }

}
