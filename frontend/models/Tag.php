<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $tag
 * @property integer $type_id
 * @property integer $field_id
 */
class Tag extends \yii\db\ActiveRecord
{

    const PERSON_TYPE = 1;
    const COMPANY_TYPE = 2;
    const PROJECT_TYPE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag', 'type_id', 'field_id'], 'required'],
            [['type_id', 'field_id'], 'integer'],
            [['tag'], 'string', 'max' => 126],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => 'Tag',
            'type_id' => 'Type ID',
            'field_id' => 'Field ID',
        ];
    }

    /**
     * @param $array Tag array
     * @return array
     */
    public static function returnAllTags($array)
    {
        $tagsReturn = [];
        $itemsClasses = [];
        foreach ($array as $item) {

            if (!isset($item->tags) || empty($item->tags)) {
                $itemsClasses[$item->id] = '';
                continue;
            }

            $tags = $item->tags;
            if (!empty($tags)) {
                $class = [];
                foreach ($tags as $tag) {
                    if (!in_array($tag->tag, $tagsReturn))
                        $tagsReturn[] = $tag->tag;
                    $tagIdInArray = array_search($tag->tag, $tagsReturn);
                    $class[] = 'item_filter_' . $tagIdInArray;
                }
                $itemsClasses[$item->id] = implode(' ', $class);
            }
        }

        return [
            'values' => $tagsReturn,
            'classes' => $itemsClasses
        ];
    }

    public static function addNew($tag, $field_id, $type)
    {

        if ($type) {
            $newTag = new self();
            $newTag->tag = $tag;
            $newTag->field_id = $field_id;
            $newTag->type_id = $type;
            $newTag->save();
        }

    }

}
