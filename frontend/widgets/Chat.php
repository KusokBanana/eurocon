<?php
namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\Json;

class Chat extends Widget
{

    public $type = 'full';

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('chat/index');
    }

}