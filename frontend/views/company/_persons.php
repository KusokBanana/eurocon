<?php

use yii\helpers\Html;
use frontend\widgets\Pagination;

/* @var $persons array */

?>

<?php if (!empty($persons['data'])): ?>
    <table class="table is-indent">
        <tbody>
            <div class="card user-following">
                <div class="card-block">
                    <div class="row">
                        <?php foreach ($persons['data'] as $person): ?>
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 m-b-20">
                                <?= Html::a(Html::img($person->image, [
                                    'alt' => '...',
                                    'width' => '128px'
                                ]), ['/site/profile', 'id' => $person->id]) ?>
                                <h4 class="font-size-16 m-b-5"><?= $person->full_name ?></h4>
                                <span>
                                    <span>architecture</span>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-xs-center ">
                        <?php $persons['data'] = $additionData; ?>

                        <?= Pagination::widget($persons); ?>
                    </div>
                </div>
            </div>
        </tbody>
    </table>
<?php endif; ?>
