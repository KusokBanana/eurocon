<?php

namespace frontend\models\books;

use frontend\models\MarketplaceItem;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_marketplace".
 *
 * @property integer $id
 * @property integer $field_id
 * @property integer $item_id
 * @property integer $type_id
 *
 * @property MarketplaceItem $item
 */
class BookMarketplace extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_marketplace';
    }

    const TYPE_FOR_COMPANY = 1;
    const TYPE_FOR_PROJECT = 2;
    const TYPE_FOR_PERSON = 3;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id', 'item_id', 'type_id'], 'required'],
            [['field_id', 'item_id', 'type_id'], 'integer'],
            [['field_id', 'item_id', 'type_id'], 'unique', 'targetAttribute' => ['field_id', 'item_id', 'type_id'],
                'message' => 'The combination of Field ID, Item ID and Type ID has already been taken.'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => MarketplaceItem::className(),
                'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field_id' => 'Field ID',
            'item_id' => 'Item ID',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(MarketplaceItem::className(), ['id' => 'item_id']);
    }


    public static function get($field_id, $type_for)
    {
        if ($field_id && $type_for) {

            $query = MarketplaceItem::find()
                ->leftJoin(self::tableName(),
                    [
                        self::tableName().'.item_id' => MarketplaceItem::tableName().'.id',
                        self::tableName().'.field_id' => $field_id,
                        self::tableName().'.type_id' => $type_for
                    ]);

            return $query;
        }

        return false;
    }

}
