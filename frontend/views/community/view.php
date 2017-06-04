<?php
/* @var $this yii\web\View */
use frontend\assets\AppAsset;
use frontend\models\Community;
use frontend\models\Company;
use frontend\widgets\CustomModal;
use frontend\widgets\Forum;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $community Company */
/* @var $followers array \frontend\models\Person */
/* @var $admins array \frontend\models\Person */
/* @var $newPost \frontend\models\Post */
/* @var $posts array \frontend\models\Post */

$this->registerJsFile('@web/js/forum.js',  ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/Plugin/input-group-file.min.js',  ['depends' => [AppAsset::className()]]);
?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="page-header h-250 " style="background-image: url(<?= Url::to('@web/img/layer_images/company-background.png') ?>);  background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-50 blue-grey-800"><?= $community->name ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Second Row -->
    <div class="col-xs-12 col-xxl-4 col-xl-4 col-lg-4">
        <div id="personalCompletedWidget" class="card card-shadow p-b-20">
            <div class="card-header card-header-transparent cover overlay">
                <?= Html::img('@web/img/portraits/placeholder.png', [
                    'class' => 'cover-image',
                ]) ?>
                <div class="overlay-panel overlay-background vertical-align" style="background-color:  #47B8C6;">
                    <div class="vertical-align-middle">
                            <?= Html::a(Html::img($community->imageShow, [
                                'title' => 'Remark'
                            ]), ["javascript:void(0)"], ['class' => 'avatar']); ?>
                        <div class="font-size-20 m-t-10"><?= $community->name ?></div>
                        <div class="font-size-14">About Construction</div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row text-xs-center m-b-20">

                    <div class="col-xs-12 ">
                        <?php if ($community->relation === Community::ROLE_ADMIN_TYPE): ?>
                            <?= Html::button('edit',
                                [
                                    'class' => 'btn btn-block btn-primary btn-outline btn-primary',
                                    'data-target' => '#community_edit',
                                    'data-toggle' => 'modal',

                                ]) ?>
                            <?= CustomModal::widget([
                                'type' => 'community_edit',
                                'model' => $community,
                                'additionalData' => [
//                                    'subscribers' => $potentialSubscribers
                                ]
                            ]) ?>
                        <?php elseif ($community->relation !== Community::ROLE_PARTICIPANT_TYPE): ?>
                            <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Follow this community',
                                ['join', 'id' => $community->id], ['class' => 'btn btn-block btn-primary']) ?>
                        <?php elseif ($community->relation === Community::ROLE_PARTICIPANT_TYPE): ?>
                            <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Unsubscribe this community',
                                ['leave', 'id' => $community->id], ['class' => 'btn btn-block btn-primary']) ?>
                        <?php endif; ?>

                        <!-- Modal body -->
                        <!-- End modal body -->
                    </div>
                </div>

                <div class="panel" id="followers">
                    <?= $this->render('_persons', [
                        'persons' => $followers,
                        'additionData' => [
                            'id' => $community->id,
                            'type' => 'followers',
                            'name' => 'Followers'
                        ]
                    ]) ?>
                </div>
                <div class="panel" id="contacts">
                    <?= $this->render('_persons', [
                        'persons' => $admins,
                        'additionData' => [
                            'id' => $community->id,
                            'type' => 'contacts',
                            'name' => 'Contacts'
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal -->
    <!-- To Do List -->
    <!-- Modal -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8" id="forum">

        <?= Forum::widget([
            'data' => $posts,
            'additionData' => [
                'id' => $community->id
            ]
        ]) ?>

    </div>

    <?= CustomModal::widget([
        'type' => 'forum_add_post',
        'model' => $newPost,
        'additionalData' => [
            'for_model' => $community
        ]
    ]) ?>

</div>

