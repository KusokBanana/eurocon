<?php
/* @var $pageNumbers array */
/* @var $page int */
/* @var $type string */
/* @var $data array */
/* @var $search string */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

if (count($pageNumbers) > 1):
?>
<nav>
    <ul data-plugin="paginator" data-total="" data-skin="pagination-no-border"
        data-wrapSelector="<?= ArrayHelper::getValue($data, 'wrapSelector') ?>"
        class="pagination pagination-no-border" data-addition='<?= Json::encode($data) ?>'>
        <?php
        $currentIndex = array_search($page, $pageNumbers);

        $prevDisabled = 'disabled';
        $prevPage = 0;
        if ($pageNumbers[0] !== $page) {
            $prevDisabled = '';
            $prevPage = $pageNumbers[$currentIndex-1];
        }
        ?>

        <li class="pagination-prev page-item <?= $prevDisabled ?>">
            <?= Html::a('<span class="icon wb-chevron-left-mini"></span>',
                ['ajax-reload', 'page' => $prevPage, 'type' => $type, 'search' => $search],
                [
                    'class' => 'page-link',
                    'aria-label' => 'Prev',
                ]) ?>
        </li>

        <?php foreach ($pageNumbers as $pageNumber): ?>

            <?php
            $active = '';
            if ($pageNumber == $page)
                $active = 'active'
            ?>
            <li class="pagination-items page-item <?= $active ?>" data-value="">
                <?= Html::a($pageNumber, ['ajax-reload', 'page' => $pageNumber, 'type' => $type, 'search' => $search],
                    ['class' => 'page-link']) ?>
            </li>

        <?php endforeach; ?>

        <?php
        $nextDisabled = 'disabled';
        $nextPage = 0;
        if ($pageNumbers[count($pageNumbers)-1] !== $page && isset($pageNumbers[$currentIndex+1])) {
            $nextDisabled = '';
            $nextPage = $pageNumbers[$currentIndex+1];
        }
        ?>

        <li class="pagination-next page-item <?= $nextDisabled ?>">
            <?= Html::a('<span class="icon wb-chevron-right-mini"></span>',
                ['ajax-reload', 'page' => $nextPage, 'type' => $type, 'search' => $search],
                [
                    'class' => 'page-link',
                    'aria-label' => 'Next',
                ]) ?>
        </li>

    </ul>
</nav>
<?php endif; ?>