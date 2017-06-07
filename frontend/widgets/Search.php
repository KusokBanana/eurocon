<?php
namespace frontend\widgets;


use yii\base\Widget;
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