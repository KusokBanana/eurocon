<?php
/* @var $this yii\web\View */
/* @var $project Project */
/* @var $participants \frontend\models\Person */
/* @var $potentialSubscribers array */
/* @var $projectTimeline \frontend\models\ProjectTimeline */
/* @var $admins array \frontend\models\Person */
/* @var $posts array \frontend\models\Post */
/* @var $newPost \frontend\models\Post */


use frontend\assets\AppAsset;
use frontend\models\Project;
use frontend\widgets\CustomModal;
use yii\helpers\Html;

$this->registerJsFile('@web/js/project.js',  ['depends' => [AppAsset::className()]]);
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
                                       aria-controls="project_timeline" role="true">Project Timeline</a>
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
                                        'participants' => $participants,
                                        'additionData' => ['id' => $project->id]
                                    ]) ?>
                                </div>

                                <div class="tab-pane animation-fade" id="forum" role="tabpanel"
                                     aria-expanded="false">

                                    <?= $this->render('_forum', [
                                        'posts' => $posts,
                                        'additionData' => [
                                            'id' => $project->id,
                                        ]
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
                'type' => 'add_project_post',
                'model' => $newPost,
                'additionalData' => [
                    'project' => $project
                ]
            ]) ?>
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
                                                'subscribers' => $potentialSubscribers
                                            ]
                                        ]) ?>
                                    <?php elseif ($project->relation !== Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Follow this project',
                                            ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php elseif ($project->relation === Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Unsubscribe this project',
                                            ['/'], ['class' => 'btn btn-block btn-primary']) ?>
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
                                                <?= Html::a($admin->user->full_name,
                                                    ['/person/profile', 'id' => $admin->user->id]); ?>
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
                    <div class="card">
                        <div class="card-header card-header-transparent p-20">
                            <h3 class="card-title m-b-0 center">Marketplace</h3>
                        </div>
                        <div class="row p-l-30 p-r-30">
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://stroyday.ru/wp-content/uploads/2015/03/%D0%9F%D0%B0%D1%80%D0%BA%D0%B5%D1%82-%D0%BF%D0%BB%D0%B0%D1%88%D0%BA%D0%B8.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">product №1</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://dkvartnsk.ru/wp-content/uploads/2012/01/L2hvbWUvc2JrcGx1c2MvcHVibGljX2h0bWwvaW1hZ2VzL3N0b3JpZXMvZGVjb3JfNDAuanBn.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">product №2</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://static.jobfine.ru/news/images/plotnik-chto-nuzhno-znat.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">service №1</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://www.sewctc.org/uploads/7/6/1/2/7612415/carpenter-new-4.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">service №2</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                        </div>
                    </div>
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
