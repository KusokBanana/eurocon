<?php

/* @var $this yii\web\View */
/* @var $person \frontend\models\Person */
/* @var $projects \frontend\models\Project array */
/* @var $isUserPage bool */
/* @var $friends \frontend\models\Person array */
/* @var $communities \frontend\models\Company array */

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
                    <div class="font-size-70 m-b-30 blue-grey-800">
                        <?= $person->name . ' ' . $person->surname ?>
                    </div>
                    <ul class="list-inline font-size-14">

                    </ul>

                    <?php
                    if ($isUserPage) {
                        echo Html::a('<span><i class="icon wb-hammer " aria-hidden="true"></i>Create a project</span>', ['/'],
                            ['class' => 'btn btn-dark btn-animate btn-animate-side']);
                    }
                    ?>

                </div>
            </div>
            <!-- End Team Total Completed -->
            <!-- End First Row -->
            <!-- Second Row -->
            <!-- Personal -->
            <div class="col-xs-12 col-xxl-3 col-xl-3 col-lg-3">
                <div id="personalCompletedWidget" class="card card-shadow p-b-20">
                    <div class="card-header card-header-transparent cover overlay">
                        <?= Html::img('@web/img/portraits/placeholder.png', [
                            'class' => 'cover-image',
                        ]) ?>
                        <div class="overlay-panel overlay-background vertical-align" style="background-color:  #FA7A7A;">
                            <div class="vertical-align-middle">
                                <?= Html::a(Html::img($person->image, [
                                    'class' => 'navbar-brand-logo navbar-brand-logo-normal',
                                    'title' => 'Remark'
                                ]), ["javascript:void(0)"], ['class' => 'avatar']); ?>
                                <div class="font-size-20 m-t-10"><?= $person->name . ' ' . $person->surname ?></div>
                                <div class="font-size-14">parquet producer</div>
				  <div class="font-size-14 m-t-"><i class="icon wb-map" aria-hidden="true"></i>Saltsburg, Austria</div>

                            </div>
                        </div>
                    </div>

                    <div class="card-block">

                        <!-- TODO here begin -->
                        <?php if ($isUserPage): ?>
                            <div class="row text-xs-center">
                                <div class="col-xs-12 ">
                                    <?= Html::a('edit', ['/'], ['class' => 'btn btn-block btn-primary btn-outline']) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row text-xs-center m-b-20">
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message',
                                        ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-users" aria-hidden="true"></i>Friends',
                                        ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="table-reponsive">
                            <div  class="card card-shadow p-b-20">

                                <div class="card-block">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    Birthday
                                                </td>

                                                <td>
                                                    <?= date('d.m.Y', strtotime($person->birthday)) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email
                                                </td>

                                                <td>
                                                    <?= $person->email ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Phone
                                                </td>
                                                <td>
                                                    <?= $person->phone ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Languages
                                                </td>
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
                                                <td>
                                                    Companies
                                                </td>
                                                <td>
                                                    Build&Co
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Competence
                                                </td>
                                                <td>
                                                    carpenter
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <!-- To Do List -->
            <div class="col-xs-12 col-xxl-9  col-xl-9 col-lg-9">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <form class="page-search-form" role="search">
                            <div class="input-search input-search-dark">
                                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search">
                                <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                            </div>
                        </form>
                        <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">

                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#all_contacts"
                                       aria-controls="all_contacts" role="tab" aria-expanded="false">Projects</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#my_contacts"
                                       aria-controls="my_contacts" role="tab" aria-expanded="true">Friends</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#google_contacts"
                                       aria-controls="google_contacts" role="tab" aria-expanded="false">Communities</a>
                                </li>
                                <!--<li class="dropdown nav-item" role="presentation" style="display: none;">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Contacts </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">All Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab">My Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#google_contacts" aria-controls="google_contacts" role="tab">Google Contacts</a>
                                    </div>
                                </li>-->
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane animation-fade" id="all_contacts" role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_projects', [
                                        'projects' => $projects,
                                        'additionData' => ['id' => $person->id]
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade active" id="my_contacts" role="tabpanel" aria-expanded="true">
                                    <?= $this->render('/tabs/_participants', [
                                        'participants' => $friends,
                                        'additionData' => ['id' => $person->id]
                                    ]) ?>
                                </div>
                                <div class="tab-pane animation-fade" id="google_contacts" role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_communities', [
                                        'communities' => $communities,
                                        'additionData' => ['id' => $person->id]
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
