<?php

/* @var $this yii\web\View */
/* @var $person \frontend\models\Person */
/* @var $projects \frontend\models\Project array */
/* @var $isUserPage bool */

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
<!--                                    <button type="button" class="btn btn-block btn-primary btn-outline " >edit</button>-->
                                    <?= Html::a('edit', ['/'], ['class' => 'btn btn-block btn-primary btn-outline']) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row text-xs-center m-b-20">
                                <div class="col-xs-6">
<!--                                    <button type="button" class="btn btn-block btn-primary"><i class="icon wb-chat-group" aria-hidden="true"></i>Message</button>-->
                                    <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message',
                                        ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                </div>
                                <div class="col-xs-6">
<!--                                    <button type="button" class="btn btn-block btn-primary"><i class="icon wb-users" aria-hidden="true"></i>Friends</button>-->
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
                                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab" aria-expanded="false">Projects</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab" aria-expanded="true">Friends</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#google_contacts" aria-controls="google_contacts" role="tab" aria-expanded="false">Communities</a></li>
                                <li class="dropdown nav-item" role="presentation" style="display: none;">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Contacts </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">All Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab">My Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#google_contacts" aria-controls="google_contacts" role="tab">Google Contacts</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane animation-fade" id="all_contacts" role="tabpanel" aria-expanded="false">
                                    <?= $this->render('_projects', compact('projects')) ?>
                                </div>
                                <div class="tab-pane animation-fade active" id="my_contacts" role="tabpanel" aria-expanded="true">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <?= Html::img('@web/img/portraits/13.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Sarah Graves
                                                        <small>Last Access: 1 hour ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 4190 W Lone Mountain Rd
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-away">
                                                        <?= Html::img('@web/img/portraits/14.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Andrew Hoffman
                                                        <small>Last Access: 2 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 2849 Spring St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-busy">
                                                        <?= Html::img('@web/img/portraits/15.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Camila Lynch
                                                        <small>Last Access: 3 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 2128 W Campbell St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-off">
                                                        <?= Html::img('@web/img/portraits/16.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Ramon Dunn
                                                        <small>Last Access: 4 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 7014 Pecan Acres Ln
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <?= Html::img('@web/img/portraits/17.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Scott Sanders
                                                        <small>Last Access: 5 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 2797 Airport St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-away">
                                                        <?= Html::img('@web/img/portraits/18.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Nina Wells
                                                        <small>Last Access: 6 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 1020 Crescent Canyon St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-busy">
                                                        <?= Html::img('@web/img/portraits/19.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Beverly Grant
                                                        <small>Last Access: 7 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 3356 Crockett St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-off">
                                                        <?= Html::img('@web/img/portraits/20.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Marvin Nelson
                                                        <small>Last Access: 8 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 1504 Mcgowen St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <?= Html::img('@web/img/portraits/1.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Herman Beck
                                                        <small>Last Access: 9 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 5858 Abby Park St
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-away">
                                                        <?= Html::img('@web/img/portraits/2.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Mary Adams
                                                        <small>Last Access: 10 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 8901 Genschaw Rd
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-busy">
                                                        <?= Html::img('@web/img/portraits/3.jpg', [
                                                            'alt' => '...',
                                                        ]) ?>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Caleb Richards
                                                        <small>Last Access: 11 hours ago</small>
                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>                          Street 7715 Washington Ave
                                                    </p>
                                                    <div>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="text-action" href="javascript:void(0)">
                                                            <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <nav>
                                        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                    </nav>
                                </div>
                                <div class="tab-pane animation-fade" id="google_contacts" role="tabpanel" aria-expanded="false">
                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="data:image/png;base64,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" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 1

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>


                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGYAAABmCAMAAAAOARRQAAAAdVBMVEUBAAL///8AAAABAAHc3NxYWFjn5+e7u7uFhYbS0tI1NTb29vbt7e2ioqL6+vqTk5N4eHjf39/Dw8NnZ2hDQkMeHR4TEhMaGRpTUlM6Ojt0c3RcXF1KSkvW1tYzMjOYmJizs7MnJieEhIW1tbWqqapiYmIkJCXZxmVyAAADIklEQVRoge2a63aqMBCFwwQVBFEC4t3Wqn3/Rzy5aAuaCQHCqaeHWcs/WcbPnT0ZEhLi/ZUgTTtEIZuwuG9MuD0BLDPWL4YtQUZx6RNz4QTCgwIESW+YWSEhIgAWTQxqggmEFCrVCM61AacBJoAvLUrPKHWPibdViuAcrRPOFvNMEaDl2S0m3t19uXsjP0AsE9sOk440WtTAvVklthUm3CAU68S2wbAjBpGcbOwEw05QsqPiDVWJ7TvAnJdAcTGSMw07Y2ZQQxEcqJtAdZg31Pwq6N2ccGZMMreicE5hTmwjJvq41X1iSAHVALA1cUyYOLPUosZtbZhABsz4Wmv+AwdPbByT7hpoUZwcTWwU46sCg1ihbTAkNoYJoaEWokAXfSIgGL6CaQyRA1fMtRw9ZvLZyP0yB7bWmNs6qcYKfQNPuMgKk1iUMaOe/cECE9kWGJyTPyXcE+ZeYDoEhdOkBpOM1IjZWqFtoEBnRsx43VmLDIB5hGN8bAXTgrOIMEyau6LIpUisx/htCoyBU0rsEoYVQFs5jjTwpQh7xpxPXSalXtBq8oi5rJxTBOdSxXSd+vqg98RWmEhskTpaoW2gtzW2xESLXrTI4E+G8Q3jbFLqOetUYOJ9nxQ5gWLipeuSL669ue0Z5iRquk5qo2dK7NbiHTGETPunCDVF96dYXQPfB5PSvpL2UG6kmDwmwddvwy3j3P28sh0+mUei+6MMYOc7TQeY8gnJq82GiSrAN/1qALdJ6hazC3mphOtB1bTDWr7w46XUt96c2TTAKI7Yu3ovKmpadNnlmZ94nuNBG32/l6gsOX4lxpk3L6Hmd2F+0htAor0abZ/lZqqLwvDHmmMobA+hJg779hjNQFMIPG2MwKU3BozbQRswQwr8q5jBm9fFDN68Lmbw5r/HDCnwupjBm9fFaAYaMExm8KZ036eCGZ/wKxuzJ4KMOaqGwuL7axUM/j4aVsh5c2i4TFL6Z9VjokPOd5P0McQWExHjJYGuh+yTlb72cOgVZivdNnaPUTwvnh+1W9/pB3oaJXqxyXMw052qJNT0mLDqYXvju4Pt4g90LjGmWXcbpQAAAABJRU5ErkJggg==" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 2

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>


                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTG1mZj_j-4QKaFgohb9K0irJJPO3GIKvmHqJr1cwZBBX99SMmqeQ" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 3

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSUQhqwznhnuV08YHOcoGczFwGDMHJ5k2nYxQ6DHTAhmr4JWbJssw" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 4

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdkHCibX93aJaga4FihDCeGtj0byNymPtj5S5FS5msWS_NXxsJ" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 5

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT_Zy2-pk2g-PVsvHHpt2z5lupNBC4kS7vv2KwmkQ0cYGjr844o" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 6

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRiR0pI4YnMeiOzvXlU0mY6i-BHvzUB0H2tJBmnSIG0FiIcOxX0" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 7

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSMc0hxgexq3ZFuIdyNEiD1eNHlAsWk5-307R-WzeEbNmz1RTgE" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 8

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRO1eTKxjqkScqpz4L2QrMGv9UJnUBNbPD0Dhi7pbPhE3b9Hvhd" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 9

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="avatar avatar-online">
                                                        <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTe9IF-IL4OXbIiDFjacsRom5sE2a4pwCwigo3EYII787FX9s3D" alt="...">

                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Community 10

                                                    </h4>
                                                    <p>
                                                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    </p>


                                                </div>
                                                <div class="media-right">
                                                    <button type="button" class="btn btn-success btn-sm">
                                                        <i class="icon wb-check" aria-hidden="true"></i>Following
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <nav>
                                        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                    </nav>
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
