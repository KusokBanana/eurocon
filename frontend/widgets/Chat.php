<?php
namespace frontend\widgets;


use frontend\models\Person;
use frontend\modules\chat\models\Conversation;
use yii\base\Widget;

class Chat extends Widget
{

    public $conversations = [];
    public $isFull = false;
    public $isAjax = true;
    private $view;
    private $new = 0;

    public function init()
    {
        parent::init();

        if (!$this->isAjax) {
            $person = Person::get();
            $data = Conversation::getDataForMiniChat($person->id, false);
            $this->conversations = $data['conversations'];
            $this->new = +$data['countNew'];
        }

        $this->view = $this->isFull ? 'chat/index' : 'chat/_items';

    }

    public function run()
    {
        return $this->render($this->view, ['conversations' => $this->conversations, 'new' => $this->new]);
    }

}