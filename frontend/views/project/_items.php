<?php
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

/** @var \frontend\models\AjaxReload $projects */

?>

<div class="page-header page-header-bordered page-header-tabs">
    <?= Search::widget([
        'extraData' => $projects->extraData,
        'query' => $projects->getSearch(),
        'data' => $projects->data,
        'type' => $projects->type,
        'wrapSelector' => '#projectsWrap'
    ]) ?>
    <br>
</div>
<div class="page-content">
    <ul class="blocks blocks-100 blocks-xxl-10 blocks-lg-3 blocks-md-2" data-plugin="filterable">
        <?php if (!empty($projects->data)):
            foreach ($projects->data as $project): ?>
                <li class="clearfix">
                    <div class="card card-shadow" style="height: 420px;">
                        <figure class="card-img-top overlay-hover overlay">
                            <?= Html::img($project->imageShow, [
                                'class' => 'overlay-figure overlay-scale',
                                'alt' => '...',
                                'height' => '310px'
                            ]) ?>
                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                <a href="<?= $project->imageShow ?>" class="icon wb-search"></a>
                            </figcaption>
                        </figure>
                        <div class="card-block">
                            <?= Html::a('<h4 class="card-title">' . $project->name . '</h4>',
                                ['/project/view', 'id' => $project->id], ['class' => 'no-underline']) ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>

            <?= Pagination::widget($projects->pagination) ?>

        <?php endif; ?>
    </ul>
</div>