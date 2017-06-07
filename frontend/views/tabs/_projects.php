<?php

/* @var $projects \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>

<br>

<?= Search::widget([
    'extraData' => $projects->extraData,
    'query' => $projects->getSearch(),
    'data' => $projects->data,
    'type' => $projects->type
]) ?>

<?php if (isset($projects->extraData['isWithCreateBtn']) && $projects->extraData['isWithCreateBtn']): ?>
    <div class="panel">
        <div class="panel-body container-fluid text-xs-center">
            <?= Html::a('<span><i class="icon wb-hammer" aria-hidden="true"></i>Create a project</span>',
                ['/project/create'],
                ['class' => 'btn btn-primary btn-animate btn-animate-side']) ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($projects->data)): ?>
    <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
        <?php foreach ($projects->data as $project): ?>
            <li class="list-group-item">
                <div class="card card-shadow">
                    <figure class="card-img-top overlay-hover overlay" style="height: 215px;">
                        <?= Html::img($project->imageShow, [
                            'class' => 'overlay-figure overlay-scale',
                            'alt' => '...'
                        ]) ?>
                        <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                            <a class="icon wb-search" href="<?= $project->imageShow ?>"></a>
                        </figcaption>
                    </figure>
                    <div class="card-block">
                        <?= Html::a("<h4 class=\"card-title\">" . $project->name . "</h4>",
                            ['/project/view', 'id' => $project->id]) ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($projects->pagination) ?>

<?php endif; ?>

