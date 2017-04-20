<?php

/* @var $projects \frontend\models\Project array*/
use yii\helpers\Html;

?>

<?php if (!empty($projects)): ?>
    <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
        <?php foreach ($projects as $project): ?>
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

    <nav>
        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
    </nav>
    
<?php endif; ?>

