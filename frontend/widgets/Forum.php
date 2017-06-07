<?php
namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\Json;

class Forum extends Widget
{

    public static $TYPE_POSTS = 1;
    public static $TYPE_COMMENTS = 2;
    public static $FORUM_MODAL_ADD_POST_ID = 'forum_add_post';

    public $data;
    public $type = 1;
    public $index = 0;

    private $view = 'forum/forum';
    private $viewData = [];

    public function init()
    {
        parent::init();

        switch ($this->type) {
            case 1:
                $this->viewData = [
                    'posts' => $this->data
                ];
                break;
            case 2:
                $this->view = 'forum/_comments';
                $this->viewData = [
                    'post' => $this->data,
                    'index' => $this->index
                ];
        }


    }

    public function run()
    {
        return $this->render($this->view, $this->viewData);
    }

}