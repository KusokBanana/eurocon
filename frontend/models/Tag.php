<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
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
class Tag extends ActiveRecord
{

    const PERSON_TYPE = 1;
    const COMPANY_TYPE = 2;
    const PROJECT_TYPE = 3;
    const COMMUNITY_TYPE = 4;

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


    public static function newTagsFromString($tagValuesString, $fields_id, $type)
    {
        if ($tagValuesString) {
            $tags = explode(',', $tagValuesString);
            foreach ($tags as $tag) {
                Tag::addNew($tag, $fields_id, $type);
            }
        }
    }

    public static function updateAllTags($tagValuesString, $fields_id, $type)
    {
        self::deleteSelected($fields_id, $type);
        self::newTagsFromString($tagValuesString, $fields_id, $type);

    }

    public static function deleteSelected($field_id, $type)
    {
        static::deleteAll(['field_id' => $field_id, 'type_id' => $type]);
    }

    /**
     * @param bool $isForLocations
     * @return array
     */
    public static function getAllByTypes($isForLocations = false)
    {

        $tags = static::find()->all();
        $result = [
            static::PERSON_TYPE => [],
            static::COMPANY_TYPE => [],
            static::PROJECT_TYPE => [],
            static::COMMUNITY_TYPE => [],
        ];
        if (!empty($tags)) {
            /** @var Tag $tag */
            foreach ($tags as $tag) {
                if (isset($result[$tag->type_id][$tag->field_id])) {
                    if ($isForLocations) {
                        $result[$tag->type_id][$tag->field_id][$tag->tag] = $tag->tag;
                    } else {
                        $result[$tag->type_id][$tag->field_id][] = $tag->tag;
                    }
                } else {
                    if ($isForLocations) {
                        $result[$tag->type_id][$tag->field_id] = [$tag->tag => $tag->tag];
                    } else {
                        $result[$tag->type_id][$tag->field_id] = [$tag->tag];
                    }
                }
            }
        }
        return $result;

    }

}
