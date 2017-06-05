<?php
namespace frontend\widgets;


use yii\base\Widget;
use yii\helpers\Json;

class Pagination extends Widget
{

    public $count;
    public $page;
    public $pageCount;
    public $type;
    public $data;
    public $search = '';
    public $filter = '';

    private $pageNumbers;

    public function init()
    {
        parent::init();

        $this->pageNumbers = $this->getPagesArray();
    }

    public function run()
    {
        return $this->render('pagination', [
            'pageNumbers' => $this->pageNumbers,
            'page' => $this->page,
            'type' => $this->type,
            'data' => $this->data,
            'search' => $this->search,
        ]);
    }

    public function getPagesArray()
    {
        $page = $this->page;
        $totalPagesCount = ceil($this->count / $this->pageCount);
//        $topPage = ($page + 2 < $totalPagesCount) ? ($page + 4) : $totalPagesCount;
//        $bottomPage = ($page - 2 > 0) ? $page - 2 : 1;

        $pages = [];
        for ($i = $j = $page; ; $i++, $j--) {

            $zero = 0;
            if ($i <= $totalPagesCount) {
                $pages[] = $i;
                $zero++;
            }
            if ($j > 0 && $i !== $j) {
                $pages[] = $j;
                $zero++;
            }

            if (count($pages) == 5 || $zero == 0)
                break;

        }
        sort($pages);

        return $pages;
    }

}