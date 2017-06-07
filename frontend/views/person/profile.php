<?php

/* @var $this yii\web\View */
/* @var $person Person */
/* @var $projects \frontend\models\AjaxReload */
/* @var $follows \frontend\models\AjaxReload */
/* @var $companies \frontend\models\AjaxReload */
/* @var $communities \frontend\models\AjaxReload  */
/* @var $marketplace \frontend\models\AjaxReload  */

use frontend\models\Person;
use frontend\widgets\CustomModal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Eurocon / profile';

?>

<!-- Page -->
<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-300 m-b-30"
                 style="background-image: url(<?= \yii\helpers\Url::to('@web/img/layer_images/first-page-image.jpg') ?>);
                    background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b- blue-grey-800">
                        <?= $person->name . ' ' . $person->surname ?>
                    </div>
                    <ul class="list-inline font-size-14">

                    </ul>

                    <?php
                    if ($person->relation === Person::RELATION_SELF): ?>
                    <div class="btn-group" role="group">
                        <?= Html::a('<span><i class="icon wb-hammer" aria-hidden="true"></i>Start to create</span>',
                            '#',
                            [
                                'class' => 'btn btn-dark btn-animate btn-animate-side',
                                'data-toggle' => 'dropdown',
                                'aria-expanded' => 'false',
                                'style' => 'border-radius: .215rem',
                                'id' => 'profileCreateBtns'
                            ]); ?>
                        <div class="dropdown-menu" aria-labelledby="profileCreateBtns" role="menu">
                            <?= Html::a('Create a project', ['/project/create'],
                                ['role' => 'menuitem', 'class' => 'dropdown-item']) ?>
                            <?= Html::a('Create a company', ['/company/create'],
                                ['role' => 'menuitem', 'class' => 'dropdown-item']) ?>
                            <?= Html::a('Create a community', ['/community/create'],
                                ['role' => 'menuitem', 'class' => 'dropdown-item']) ?>
                            <?= Html::a('Create a product', ['/product/create'],
                                ['role' => 'menuitem', 'class' => 'dropdown-item']) ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- End Team Total Completed -->
            <!-- End First Row -->
            <!-- Second Row -->
            <!-- Personal -->
            <div class="col-xs-12 col-lg-4 col-xxl-3 col-xl-3">
                <div id="personalCompletedWidget" class="card card-shadow p-b-20">
                    <div class="card-header card-header-transparent cover overlay">
                        <?= Html::img('@web/img/portraits/placeholder.png', [
                            'class' => 'cover-image',
                        ]) ?>
                        <div class="overlay-panel overlay-background vertical-align" style="background-color:  #FA7A7A;">
                            <div class="vertical-align-middle">
                                <?= Html::a(Html::img($person->imageShow, [
                                    'class' => 'navbar-brand-logo navbar-brand-logo-normal',
                                    'title' => 'Remark'
                                ]), "javascript:void(0)", ['class' => 'avatar']); ?>
                                <div class="font-size-20 m-t-10"><?= $person->name . ' ' . $person->surname ?></div>
                                <div class="font-size-14"><?= $person->position ?></div>
                                <div class="font-size-14 m-t-">
                                    <i class="icon wb-map" aria-hidden="true"></i>
                                    <?= isset($person->location['name']) ? $person->location['name'] : '' ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-block">

                        <!-- TODO here begin -->
                        <?php if ($person->relation === Person::RELATION_SELF): ?>
                            <div class="row text-xs-center">
                                <div class="col-xs-12 ">
                                    <?= Html::button('edit',
                                        [
                                            'class' => 'btn btn-block btn-primary btn-outline',
                                            'data-target' => '#profile_edit',
                                            'data-toggle' => 'modal',

                                        ]) ?>
                                    <?= CustomModal::widget([
                                        'type' => 'profile_edit',
                                        'model' => $person,
                                    ]) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row text-xs-center m-b-20">
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message',
                                        ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php if ($person->relation === Person::RELATION_FOLLOWING): ?>
                                        <?= Html::a('<i class="icon wb-users" aria-hidden="true"></i>Unfollow',
                                            ['/person/un-follow', 'id' => $person->id],
                                            ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php else: ?>
                                        <?= Html::a('<i class="icon wb-users" aria-hidden="true"></i>Follow',
                                            ['/person/follow', 'id' => $person->id],
                                            ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div  class="card card-shadow p-b-20">

                            <div class="card-block p-r-0 p-l-0">
                                    <table class="table table-sm"
                                           style="width: 100%; word-wrap: break-word;
                                           table-layout: fixed; min-width: 200px;">
                                        <tbody>
                                        <tr>
                                            <td>Birthday</td>
                                            <td><?= date('d.m.Y', strtotime($person->birthday)) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= $person->email ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?= $person->phone ?></td>
                                        </tr>
                                        <tr>
                                            <td>Languages</td>
                                            <td>
                                                <?= Html::img('@web/img/examples/country/germany-icon.png', [
                                                    'title' => 'Germany',
                                                    'alt' => 'GermanyGermany',
                                                ]) ?>
                                                <?= Html::img('@web/img/examples/country/uk-icon.png', [
                                                    'title' => 'Germany',
                                                    'alt' => 'GermanyGermany',
                                                ]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Competence</td>
                                            <td><?php
                                                if (!empty($person->ownTags)) {
                                                    foreach ($person->ownTags as $tag) {
                                                        echo '<span class="tag tag-round tag-primary">'.
                                                            $tag->tag . '</span> ';
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!-- To Do List -->
            <div class="col-xs-12 col-lg-8 col-xxl-9 col-xl-9">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">

                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#tab_projects"
                                       aria-controls="all_contacts" role="tab" aria-expanded="true">Projects</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab_companies"
                                       aria-controls="google_contacts" role="tab" aria-expanded="false">Companies</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab_followers"
                                       aria-controls="my_contacts" role="tab" aria-expanded="false">Followers</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab_communities"
                                       aria-controls="communities" role="tab" aria-expanded="false">Communities</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab_marketplace"
                                       aria-controls="marketplace" role="tab" aria-expanded="false">Products</a>
                                </li>
                            </ul>

                            <?php $isWithCreateBtn = $person->relation === Person::RELATION_SELF; ?>

                            <div class="tab-content">
                                <div class="tab-pane animation-fade active" id="tab_projects"
                                     role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_projects', [
                                        'projects' => $projects->joinExtraData([
                                            'id' => $person->id,
                                            'isWithCreateBtn' => $isWithCreateBtn
                                        ])
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade" id="tab_followers"
                                     role="tabpanel" aria-expanded="true">
                                    <?= $this->render('_followers', [
                                        'participants' => $follows->joinExtraData([
                                            'id' => $person->id,
                                            'isWithCreateBtn' => $isWithCreateBtn
                                        ])
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade" id="tab_companies"
                                     role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_companies', [
                                        'companies' => $companies->joinExtraData([
                                            'id' => $person->id,
                                            'isWithCreateBtn' => $isWithCreateBtn
                                        ])
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade" id="tab_communities"
                                     role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_communities', [
                                        'communities' => $communities->joinExtraData([
                                            'id' => $person->id,
                                            'isWithCreateBtn' => $isWithCreateBtn
                                        ])
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade" id="tab_marketplace"
                                     role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_marketplace', [
                                        'items' => $marketplace->joinExtraData([
                                            'isWithCreateBtn' => $isWithCreateBtn
                                        ])
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div>
        </div>
        <!-- End To Do List -->

        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>

