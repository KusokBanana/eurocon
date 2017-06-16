<?php
namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class Search extends Widget
{

    public $query;
    public $extraData;
    public $data;
    public $type;
    public $wrapSelector = false;

    private $isEmpty;

    public function init()
    {
        parent::init();

        $this->isEmpty = empty($this->data);
        $this->wrapSelector = (!$this->wrapSelector) ? ArrayHelper::getValue($this->extraData, 'wrapSelector', '') :
            $this->wrapSelector;
    }

    public function run()
    {
        return $this->render('search', [
            'type' => $this->type,
            'extraData' => $this->extraData,
            'query' => $this->query,
            'isEmpty' => $this->isEmpty,
            'wrapSelector' => $this->wrapSelector
        ]);
    }

}