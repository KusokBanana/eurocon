<?php
/* @var $this yii\web\View */
/* @var $project Project */
/* @var $participants \frontend\models\AjaxReload */
/* @var $potentialSubscribers array */
/* @var $projectTimeline \frontend\models\ProjectTimeline */
/* @var $admins array */
/* @var $posts \frontend\models\AjaxReload */
/* @var $newPost \frontend\models\Post */
/* @var $marketplaceItems \frontend\models\AjaxReload */


use frontend\assets\AppAsset;
use frontend\models\Project;
use frontend\widgets\CustomModal;
use frontend\widgets\Forum;
use yii\helpers\Html;

$this->registerJsFile('@web/js/project.js',  ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/forum.js',  ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/Plugin/input-group-file.min.js',  ['depends' => [AppAsset::className()]]);
?>

<div class="page">

    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-150 m-b-30"  style="border: double 10px; border-color: #57c7d4; background-color: #E8F1F8;">
                <div class="text-xs-center blue-grey-800 m-t-0 m-xs-0">
                    <div class="font-size-50 m-b-30 blue-grey-800">
                        <?= $project->name ?>
                    </div>

                </div>
            </div>
            <!-- End Team Total Completed -->
            <!-- End First Row -->
            <div class="col-xs-12 col-xxl-8  col-xl-8 col-lg-8">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">

                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#project_timeline"
                                       aria-controls="project_timeline" role="tab">Project Timeline</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#participants"
                                       aria-controls="participants" role="tab" aria-expanded="false">Participants</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#forum"
                                       aria-controls="forum" role="tab" aria-expanded="false">Forum</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane animation-fade active" id="project_timeline"
                                     role="tabpanel" aria-expanded="false">
                                    <?= $this->render('_timeline', [
                                        'project' => $project,
                                        'timelines' => $projectTimeline
                                    ]) ?>
                                </div>

                                <div class="tab-pane animation-fade" id="participants" role="tabpanel"
                                     aria-expanded="false">
                                    <?= $this->render('/tabs/_participants', [
                                        'participants' => $participants->joinExtraData([
                                            'id' => $project->id,
                                            'isWithBtn' => ($project->relation === Project::RELATION_ADMIN)
                                        ]),
                                    ]) ?>
                                </div>

                                <div class="tab-pane animation-fade" id="forum" role="tabpanel"
                                     aria-expanded="false">

                                    <?= Forum::widget([
                                        'data' => $posts->joinExtraData([
                                                'id' => $project->id,
                                                'search-wrapper-class' => 'input-search-dark',
                                                'wrapSelector' => '#forum'
                                            ]),
                                    ]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div><!-- Second Row -->
            <!-- Personal -->
            <?= CustomModal::widget([
                'type' => Forum::$FORUM_MODAL_ADD_POST_ID,
                'model' => $newPost,
                'additionalData' => [
                    'for_model' => $project
                ]
            ]) ?>


            <?php
            if ($project->relation === Project::RELATION_ADMIN):
                echo CustomModal::widget([
                    'type' => 'add_persons',
                    'model' => $project,
                    'additionalData' => [
                        'id' => $project->id,
                        'type' => 'participants',
                        'subscribers' => $potentialSubscribers['cooperation'],
                    ]
                ]);
            endif;
            ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4 col-xl-4">
                <div class="col-xs-12 col-xxl-12 col-xl-12 col-lg-12 ">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row text-xs-center m-b-20">
                                <div class="col-xs-12 ">

                                    <?php if ($project->relation === Project::RELATION_ADMIN): ?>
                                        <?= Html::button('edit',
                                            [
                                                'class' => 'btn btn-block btn-primary btn-outline btn-primary m-b-20',
                                                'data-target' => '#project_edit',
                                                'data-toggle' => 'modal',

                                            ]) ?>
                                        <?= CustomModal::widget([
                                            'type' => 'project_edit',
                                            'model' => $project,
                                            'additionalData' => [
                                                'subscribers' => $potentialSubscribers['admins']
                                            ]
                                        ]) ?>
                                    <?php elseif ($project->relation !== Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Follow this project',
                                            ['join', 'id' => $project->id], ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php elseif ($project->relation === Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Unsubscribe this project',
                                            ['leave', 'id' => $project->id], ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Project owners:
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($admins)):
                                            foreach ($admins as $key => $admin): ?>
                                                <?= Html::a($admin->person->full_name,
                                                    ['/person/profile', 'id' => $admin->person->id]); ?>
                                                <?= ($key < count($admins) - 1) ? ', ' : ''; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Project name:
                                    </td>
                                    <td>
                                        <?= $project->name ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tags:
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($project->ownTags)) {
                                            foreach ($project->ownTags as $tag) {
                                                echo '<span class="tag tag-round tag-primary">'.
                                                    $tag->tag . '</span> ';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td><?= $project->date ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Project Links:</td>
                                    <td>
                                        <?php if ($project->project_links): ?>
                                            <?php foreach (explode(',', $project->project_links) as $link): ?>
                                                <a href="<?= 'http://www.' . $link ?>"><?= 'http://www.' . $link ?></a>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social share:
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon social-facebook"><i class="icon bd-facebook" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-twitter"><i class="icon bd-twitter" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-linkedin"><i class="icon bd-linkedin" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-instagram"><i class="icon bd-instagram" aria-hidden="true"></i></button>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-xxl-12 col-xl-12 col-lg-12">
                    <?= $this->render('_marketplace', [
                        'items' => $marketplaceItems->joinExtraData(['id' => $project->id]),
                    ]) ?>
                </div>
            </div>

            <!-- End Personal -->
            <!-- To Do List -->

        </div>
        <!-- End To Do List -->

        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>
