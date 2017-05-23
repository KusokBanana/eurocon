<?php
namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\Json;

class CustomModal extends Widget
{

    public $model;
    public $type;
    public $additionalData = [];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('modals/'.$this->type, [
            'model' => $this->model,
            'type' => $this->type,
            'data' => $this->additionalData
        ]);
    }

}