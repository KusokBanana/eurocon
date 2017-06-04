<?php

namespace frontend\models\books;

use Yii;

/**
 * This is the model class for table "book_marketplace".
 *
 * @property integer $id
 * @property integer $field_id
 * @property integer $item_id
 * @property integer $type_id
 */
class BookMarketplace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_marketplace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id', 'item_id', 'type_id'], 'required'],
            [['field_id', 'item_id', 'type_id'], 'integer'],
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
}
