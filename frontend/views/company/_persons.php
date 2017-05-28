<?php

use frontend\models\Company;
use frontend\widgets\CustomModal;
use yii\helpers\Html;
use frontend\widgets\Pagination;

/* @var $persons array */
/* @var $company \frontend\models\Company */
/* @var $potential array Person */

?>

<table class="table is-indent">
    <tbody>
        <div class="card user-following">
            <div class="card-block">
                <?php if (!empty($persons['data'])): ?>
                    <div class="row">
                        <?php foreach ($persons['data'] as $personData): ?>
                            <?php $person = $personData->person; ?>
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 m-b-20">
                                <?= Html::a(Html::img($person->imageShow, [
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
                <?php endif; ?>

                <div class="row">
                    <?php $persons['data'] = $additionData; ?>

                    <?php if ($company->relation === Company::ROLE_ADMIN_TYPE): ?>
                        <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            <?= Html::button('<i class="icon wb-plus"></i> Add',
                                    [
                                        'class' => 'btn btn-outline btn-primary',
                                        'data-target' => '#add_persons_' . $additionData['type'],
                                        'data-toggle' => 'modal',

                                    ]) ?>
                        </div>
                    <?php endif; ?>

                    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="text-xs-center ">
                    <?= Pagination::widget($persons); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </tbody>
</table>
