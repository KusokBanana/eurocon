<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_type_id', 'name'], 'required'],
            [['item_type_id', 'type_id', 'status_id', 'budget_id', 'category_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 126],
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
        ];
    }
}
