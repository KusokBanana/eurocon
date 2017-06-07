<?php

use yii\helpers\Html;
use frontend\widgets\Pagination;
use yii\helpers\Url;
use frontend\widgets\Search;

/* @var $projects \frontend\models\AjaxReload */

?>
<br>
<?= Search::widget([
    'extraData' => $projects->extraData,
    'query' => $projects->getSearch(),
    'data' => $projects->data,
    'type' => $projects->type
]) ?>

<?php if (!empty($projects->data)): ?>
    <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
        <?php foreach ($projects->data as $projectData): ?>
            <?php /** @var \frontend\models\Project $project */
            $project = $projectData->project; ?>
            <li class="list-group-item">
                <div class="card card-shadow">
                    <figure class="card-img-top overlay-hover overlay" style="height: 210px;">
                        <?= Html::img($project->imageShow, [
                            'class' => 'overlay-figure overlay-scale',
                            'alt' => '...'
                        ]) ?>
                        <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                            <a class="icon wb-search" href="<?= Url::to($project->imageShow) ?>"></a>
                        </figcaption>
                    </figure>
                    <div class="card-block">

                            <?= Html::a('<h4 class="card-title">'.$project->name.'</h4>',
                                ['/project/view', 'id' => $project->id],
                                ['class' => 'no-underline']); ?>

                        <p class="card-text">
                            <?= $project->statusData['icon'] . ' ' . $project->statusData['name'] ?>
                        </p>

                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($projects->pagination); ?>

<?php endif; ?>
