<?php

namespace frontend\models;


use Symfony\Component\Debug\Tests\Fixtures\ClassAlias;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * @property ActiveQuery $query
 */

class AjaxReload
{

    public $count;
    public $page = 1;
    public $pageCount;
    public $type;
    public $data = [];
    public $filter = [];
    public $extraData = [];
    public $pagination;

    private $query;
    private $searchString = '';
    private $queryTableName;
    private $queryClass;

    /**
     * @param $page int
     * @param $limit int
     * @param $type string
     * @return array
     * @internal param array $filter
     */
    public function setData($page, $limit, $type)
    {
        $count = $this->query->count();

        $maxPages = ($limit) ? (floor($count / $limit) ? floor($count / $limit) : 1) : 1;
        $page = $page > 0 ? $page : 1;
        $page = ($page <= $maxPages) ? $page : $maxPages;

        $offset = ($page - 1) * $limit;

        $this->count = $count;

        if (!is_null($limit))
            $this->query->limit($limit)->offset($offset);

        $this->page = $page;
        $this->pageCount = $limit;
        $this->type = $type;
        $this->data = $this->query->all();
        $this->pagination = $this->getPagination();

    }

    /**
     * @param mixed $func
     * @return $this
     */
    public function setFilters($func = false)
    {

        if ($func) {
            $this->filter = $func;
        } else {

            $filter = ArrayHelper::getValue($this->extraData, 'filter', []);
            $where = [];
            $newFilter = [];
            /** @var ActiveRecord $obj */
            $obj = new $this->queryClass();
            if ($filter && !empty($filter)) {
                foreach ($filter as $oneFilter) {
                    $name = ArrayHelper::getValue($oneFilter, 'name');
                    $value = ArrayHelper::getValue($oneFilter, 'value');
                    $isAttr = $obj->hasAttribute($name);
                    if ($name && $isAttr && $value) {
                        $where[$this->queryTableName . '.' . $name] = $value;
                        $newFilter[$name] = $value;
                    }
                }
            }

            $this->filter = $newFilter;
            $this->query->andWhere($where);
            $this->search();

        }

        return $this;

    }

    public function search()
    {

        $search = ArrayHelper::getValue($this->extraData, 'search', '');

        if ($search) {
            $this->query->andFilterWhere(['LIKE', $this->getSearchString(), $search]);
        }

        return $this;

    }

    /**
     * @param string $searchString
     * @return AjaxReload
     */
    public function setSearchString($searchString)
    {
        $this->searchString = $searchString;
        return $this;
    }

    public function getSearchString()
    {
        return ($this->searchString) ? $this->searchString : ($this->queryTableName . '.name');
    }


    public function getFilterVal($name)
    {

        return ArrayHelper::getValue($this->filter, $name, false);

    }

    public function getSearch()
    {
        return ArrayHelper::getValue($this->extraData, 'search', '');
    }

    /**
     * @param $query
     * @param array $extraData
     * @param bool $primaryClass
     * @return $this
     */
    public function init($query, $extraData = [], $primaryClass = false)
    {

        $this->setQuery($query, $primaryClass);
        $this->extraData = $extraData;
        return $this;

    }

    /**
     * @param $query
     * @param $primaryClass
     */
    private function setQuery($query, $primaryClass)
    {
        $class = ($primaryClass) ? $primaryClass : $query->modelClass;
        /** @var ActiveRecord $class */
        $this->queryClass = $class;
        $this->queryTableName = $class::tableName();
        $this->query = $query;
    }

    public function setQueryValue($query)
    {
        $this->query = $query;
        return $this;
    }

    public function getPagination()
    {
        return [
            'count' => $this->count,
            'page' => $this->page,
            'pageCount' => $this->pageCount,
            'type' => $this->type,
            'extraData' => $this->extraData,

        ];
    }

    public function joinExtraData($extraData)
    {
        $this->extraData = ArrayHelper::merge($this->extraData, $extraData);
        $this->pagination = $this->getPagination();
        return $this;
    }

}