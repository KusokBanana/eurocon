<?php

/* @var $projects array */
/* @var $projects['data'] \frontend\models\Project array */
/* @var $additionData array*/

use frontend\widgets\Pagination;
use yii\helpers\Html;

?>

<?php if (!empty($projects)): ?>
    <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
        <?php foreach ($projects['data'] as $project): ?>
            <li class="list-group-item">
                <div class="card card-shadow">
                    <figure class="card-img-top overlay-hover overlay">
                        <?= Html::img($project->image, [
                            'class' => 'overlay-figure overlay-scale',
                            'alt' => '...'
                        ]) ?>
                        <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                            <a class="icon wb-search" href="<?= $project->image ?>"></a>
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

    <?php $projects['data'] = $additionData ?>
    <?= Pagination::widget($projects) ?>

<?php endif; ?>

