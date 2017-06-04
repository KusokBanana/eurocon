<?php
/* @var $this yii\web\View */
use frontend\models\Company;
use frontend\widgets\CustomModal;
use voime\GoogleMaps\MapInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $company Company */
/* @var $cooperation array \frontend\models\Person */
/* @var $admins array \frontend\models\Person */
/* @var $potentialSubscribers array \frontend\models\Person */
/* @var $projects array \frontend\models\Project */
/* @var $marketplace array \frontend\models\MarketplaceItem */
/* @var $newMarketplaceItem \frontend\models\MarketplaceItem */

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
        <?php if ($company->relation === Company::ROLE_ADMIN_TYPE): ?>
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
        <?php endif; ?>

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

                    <div  class="card card-shadow p-b-20">

                        <div class="card-block p-r-0 p-l-0">
                            <table class="table table-sm">
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
                                <tr>
                                    <td>Company Foundation</td>
                                    <td><?= date('d.m.Y', strtotime($company->birthday)) ?></td>
                                </tr>
                                </tbody>
                            </table>
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
                                <?= $this->render('_marketplace', [
                                    'items' => $marketplace,
                                    'additionData' => [
                                        'id' => $company->id,
                                    ]
                                ]) ?>
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

<?php if ($company->relation === Company::ROLE_ADMIN_TYPE): ?>
<?= CustomModal::widget([
    'type' => 'add_marketplace_item',
    'model' => $newMarketplaceItem,
    'additionalData' => []
]) ?>
<?php endif; ?>

