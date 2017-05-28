<?php
/* @var $this yii\web\View */
use frontend\models\Company;
use frontend\widgets\CustomModal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $company Company */
/* @var $cooperation array \frontend\models\Person */
/* @var $admins array \frontend\models\Person */
/* @var $potentialSubscribers array \frontend\models\Person */
/* @var $projects array \frontend\models\Project */

// TODO добавить сюда новые скрипты
?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-300 m-b-30"
                 style="background-image: url(<?= \yii\helpers\Url::to('@web/img/layer_images/company-background.png') ?>);
                         background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-30 blue-grey-800"><?= $company->name ?></div>
                    <?php if ($company->location): ?>
                        <ul class="list-inline font-size-14">
                            <li class="list-inline-item">
                                <i class="icon wb-map m-r-5" aria-hidden="true"></i>
                                <b><?= ArrayHelper::getValue($company->location, 'name'); ?></b>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Team Total Completed -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body p-0">


                        <div class="page-nav-tabs">
                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#team" aria-controls="team" aria-expanded="true" role="tab">Team</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#cooperation" aria-controls="cooperation" aria-expanded="false" role="tab">Cooperation</a>
                                </li>
                            </ul>
                        </div>

                        <div class="page-content tab-content page-content-table nav-tabs-animate">
                            <div class="tab-pane animation-fade active" id="team" role="tabpanel" aria-expanded="true">
                                <?php
                                $adminsAddData = [
                                    'id' => $company->id,
                                    'type' => 'admins',
                                    'subscribers' => $potentialSubscribers['admins'],
                                ];
                                $coopAddData = [
                                    'id' => $company->id,
                                    'type' => 'participants',
                                    'subscribers' => $potentialSubscribers['cooperation'],
                                ];
                                ?>
                                <?= $this->render('_persons', [
                                    'persons' => $admins,
                                    'company' => $company,
                                    'additionData' => $adminsAddData,
                                ]) ?>
                            </div>

                            <div class="tab-pane animation-fade" id="cooperation" role="tabpanel" aria-expanded="false">
                                <?= $this->render('_persons', [
                                    'persons' => $cooperation,
                                    'company' => $company,
                                    'additionData' => $coopAddData,
                                ]) ?>
                            </div>
                    </div>

                </div>
                <!-- End Panel -->
            </div>
        </div>

            <?= CustomModal::widget([
                'type' => 'add_persons',
                'model' => $company,
                'additionalData' => $coopAddData
            ]) ?>
            <?= CustomModal::widget([
                'type' => 'add_persons',
                'model' => $company,
                'additionalData' => $adminsAddData
            ]) ?>

            <!-- Personal -->
            <div class="col-xs-12 col-xxl-4 col-xl-4 col-lg-4">

            <div id="personalCompletedWidget" class="card card-shadow p-b-20">

                <div class="card-header card-header-transparent cover overlay">
                    <?= Html::img('@web/img/portraits/placeholder.png', [
                        'class' => 'cover-image',
                    ]) ?>
                    <div class="overlay-panel overlay-background vertical-align" style="background-color:  #47B8C6;">
                        <div class="vertical-align-middle">
                            <?= Html::a(
                                    Html::img($company->imageShow, [
                                    'class' => 'cover-image',
                            ]), ['/'], ['class' => 'avatar']) ?>
                            <div class="font-size-20 m-t-10"><?= $company->name ?></div>
                            <div class="font-size-14"><?= $company->specialty ?></div>
                        </div>
                    </div>
                </div>

                <div class="card-block">
                    <div class="row text-xs-center m-b-20">
                        <?php if ($company->relation === Company::ROLE_ADMIN_TYPE): ?>
                            <div class="col-xs-12 ">
                                <?= Html::button('edit',
                                        [
                                            'class' => 'btn btn-block btn-primary btn-outline btn-primary m-b-20',
                                            'data-target' => '#company_edit',
                                            'data-toggle' => 'modal',

                                        ]) ?>
                                    <?= CustomModal::widget([
                                        'type' => 'company_edit',
                                        'model' => $company,
                                    ]) ?>
                            </div>
                            <?php elseif ($company->relation !== Company::ROLE_PARTICIPANT_TYPE): ?>
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message', ['/'],
                                        ['class' => 'btn btn-block btn-primary']);
                                    ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-user-add" aria-hidden="true"></i>Join',
                                        ['join', 'id' => $company->id],
                                        ['class' => 'btn btn-block btn-primary']); ?>
                                </div>
                            <?php elseif ($company->relation === Company::ROLE_PARTICIPANT_TYPE): ?>
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message', ['/'],
                                        ['class' => 'btn btn-block btn-primary']);
                                    ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= Html::a('<i class="icon fa-times" aria-hidden="true"></i>Leave',
                                        ['leave', 'id' => $company->id],
                                        ['class' => 'btn btn-block btn-primary']); ?>
                                </div>
                            <?php endif; ?>

                    </div>
                    <div class="table-reponsive">

                        <div  class="card card-shadow p-b-20">

                            <div class="card-block">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Location</td>
                                            <td><?= ArrayHelper::getValue($company->location, 'name'); ?></td>
                                        </tr>
<!--                                        <tr>-->
<!--                                            <td>Countries</td>-->
<!--                                            <td>Austria, Germany, Poland</td>-->
<!--                                        </tr>-->
                                        <tr>
                                            <td>Types of jobs</td>
                                            <td><?= join(',', ArrayHelper::getColumn($company->tags, 'tag')); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?= $company->email ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?= $company->phone ?></td>
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body">
                    <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#projects"
                                   aria-controls="all_contacts" role="tab" aria-expanded="false">Projects</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#marketplace"
                                   aria-controls="my_contacts" role="tab" aria-expanded="true">Marketplace</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane animation-fade" id="projects" role="tabpanel" aria-expanded="false">
                                <?= $this->render('_projects', [
                                    'projects' => $projects,
                                    'additionData' => [
                                        'id' => $company->id,
                                    ]
                                ]) ?>
                            </div>
                            <div class="tab-pane active" id="marketplace" role="tabpanel" aria-expanded="true">
                                <form class="page-search-form m-t-10" role="search">
                                    <div class="input-search input-search-dark">
                                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                        <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search">
                                        <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                                    </div>
                                </form>
                                <div class="panel">

                                    <div class="panel-body container-fluid">
                                        <div class="row row-lg">

                                            <div class="col-md-4 col-xl-3 col-xs-12">
                                                <!-- Example Basic -->

                                                <div class="radio-custom radio-primary m-l-30" style="display: inline-block; padding-left: 20px;">
                                                    <input type="radio" id="inputRadiosUnchecked" name="inputRadios">
                                                    <label for="inputRadiosUnchecked">Offers</label>
                                                </div>
                                                <div class="radio-custom radio-primary m-l-30">
                                                    <input type="radio" id="inputRadiosUnchecked" name="inputRadios">
                                                    <label for="inputRadiosUnchecked">Requests</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xl-4 col-xs-12">
                                                <!-- Example Colors -->
                                                <div class="form-group row">
                                                    <label class="form-control-label col-xs-12 col-md-3">Type:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <select class="form-control">
                                                            <option>New building</option>
                                                            <option>Renovation</option>
                                                            <option>Extension</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="form-control-label col-xs-12 col-md-3">Budget:</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <select class="form-control">
                                                            <option>[ 0; 1 mln $ ]</option>
                                                            <option>[ 1 mln $; 3 mln $ ]</option>
                                                            <option>[ 3 mln $; 5 mln $ ]</option>
                                                            <option>[ 5 mln $; 10 mln $ ]</option>
                                                            <option> &gt;10 mln $ </option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-4 col-xl-3 col-xs-12 p-t-30">
                                                <button type="button" class="btn btn-outline btn-primary" data-target="#exampleTabs123" data-toggle="modal"><i class="icon wb-plus" aria-hidden="true"></i> Add offers or request</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="media media-lg">
                                            <div class="media-body">
                                                <div class="profile-brief">
                                                    <div class="media">
                                                        <a class="media-left">
                                                            <img class="media-object" src="../../global/photos/placeholder.png" alt="...">
                                                        </a>
                                                        <div class="media-body p-l-20">
                                                            <h4 class="media-heading">Getting Started</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit. Integer nec odio. Praesent libero. Sed
                                                                cursus ante dapibus diam. Sed nisi. Nulla quis
                                                                sem at nibh elementum imperdiet. Duis sagittis
                                                                ipsum. Praesent mauris.</p>
                                                        </div>
                                                        <div class="media-left media-middle"  style="border-left: 1px solid rgb(213,228,241); padding: 15px;">
                                                            <span>01.01.2018</span>
                                                            <span>Jo Smith</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media media-lg">
                                            <div class="media-body">
                                                <div class="profile-brief">
                                                    <div class="media">
                                                        <a class="media-left">
                                                            <img class="media-object" src="../../global/photos/placeholder.png" alt="...">
                                                        </a>
                                                        <div class="media-body p-l-20">
                                                            <h4 class="media-heading">Getting Started</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit. Integer nec odio. Praesent libero. Sed
                                                                cursus ante dapibus diam. Sed nisi. Nulla quis
                                                                sem at nibh elementum imperdiet. Duis sagittis
                                                                ipsum. Praesent mauris.</p>
                                                        </div>
                                                        <div class="media-left media-middle"  style="border-left: 1px solid rgb(213,228,241); padding: 15px;">
                                                            <span>01.01.2018</span>
                                                            <span>Jo Smith</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media media-lg">
                                            <div class="media-body">
                                                <div class="profile-brief">
                                                    <div class="media">
                                                        <a class="media-left">
                                                            <img class="media-object" src="../../global/photos/placeholder.png" alt="...">
                                                        </a>
                                                        <div class="media-body p-l-20">
                                                            <h4 class="media-heading">Getting Started</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit. Integer nec odio. Praesent libero. Sed
                                                                cursus ante dapibus diam. Sed nisi. Nulla quis
                                                                sem at nibh elementum imperdiet. Duis sagittis
                                                                ipsum. Praesent mauris.</p>
                                                        </div>
                                                        <div class="media-left media-middle"  style="border-left: 1px solid rgb(213,228,241); padding: 15px;">
                                                            <span>01.01.2018</span>
                                                            <span>Jo Smith</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="media media-lg">
                                            <div class="media-body">
                                                <div class="profile-brief">
                                                    <div class="media">
                                                        <a class="media-left">
                                                            <img class="media-object" src="../../global/photos/placeholder.png" alt="...">
                                                        </a>
                                                        <div class="media-body p-l-20">
                                                            <h4 class="media-heading">Getting Started</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit. Integer nec odio. Praesent libero. Sed
                                                                cursus ante dapibus diam. Sed nisi. Nulla quis
                                                                sem at nibh elementum imperdiet. Duis sagittis
                                                                ipsum. Praesent mauris.</p>
                                                        </div>
                                                        <div class="media-left media-middle"  style="border-left: 1px solid rgb(213,228,241); padding: 15px;">
                                                            <span>01.01.2018</span>
                                                            <span>Jo Smith</span>
                                                        </div>
                                                    </div>
                                                </div>
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
            <!-- End To Do List -->

            <!-- End First Row -->
        </div>

    </div>
</div>

