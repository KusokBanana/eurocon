<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "community".
 *
 * @property integer $id
 * @property string $name
 * @property string $section
 * @property string $image_src
 * @property string $background_src
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'post_ability_id', 'acceptance_id'], 'required'],
            [['post_ability_id', 'acceptance_id'], 'integer'],
            [['name', 'section', 'image_src', 'background_src'], 'string', 'max' => 126],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Community Name',
            'section' => 'Community section',
            'image_src' => 'Community Photo',
            'background_src' => 'Background Image',
            'post_ability_id' => 'Who can add post',
            'acceptance_id' => 'How to join community',
        ];
    }
}
