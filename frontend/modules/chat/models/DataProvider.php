<?php
namespace frontend\modules\chat\models;

use yii\base\Arrayable;
use yii\base\ArrayableTrait;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class DataProvider
 * @package frontend\models\chat
 *
 */
class DataProvider extends ActiveDataProvider implements Arrayable
{
    use ArrayableTrait;

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'totalCount',
            'keys',
            'models',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getModels()
    {
        return ArrayHelper::toArray(parent::getModels());
    }

    /**
     * @param $obj self
     */
    public static function transformToArray(&$obj)
    {
        /** @var ActiveQuery $query */
        $query = $obj->query;
        $array = $obj->toArray();
        $array['models'] = $query->all();
        $obj = $array;
    }

}
