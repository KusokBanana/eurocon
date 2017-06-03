<?php
use frontend\assets\AppAsset;
use frontend\models\Post;
use frontend\models\Project;
use frontend\models\ProjectTimeline;
use frontend\widgets\CustomModal;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

/** @var \yii\web\View $this */
/** @var Post $posts */

?>
<div class="panel">
    <div class="row">
        <div class="col-lg-8 col-xl-8 col-xxl-8 m-t-20 m-l-15">
            <div class="form-group">
                    <?= Search::widget([
                        'additionData' => ArrayHelper::merge($additionData, [
                            'placeholder' => 'Find post...'
                        ]),
                        'query' => ArrayHelper::getValue($additionData, 'search', null),
                        'data' => $posts['data'],
                        'type' => $posts['type']
                    ]) ?>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 col-xxl-3 m-t-20 m-l-20 text-xs-center">
            <?= Html::button('Add post',
                [
                    'class' => 'btn btn-outline btn-primary',
                    'data-target' => '#add_project_post',
                    'data-toggle' => 'modal',

                ]) ?>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <?php if (!empty($posts)): ?>
            <?php /** @var Post $post */
            foreach ($posts['data'] as $post): ?>
                <div class="col-xs-12 col-lg-12 col-sm-12"
            <!-- Widget -->
                    <div class="card card-shadow">
                        <div class="row">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <?php if (!empty($post->image_srcs)): ?>
                                <?php $sliderId = 'forumPostSlider_' . $post->id ?>
                                    <div class="card-img-top cover">
                                        <div class="cover-gallery carousel slide"
                                             id="<?= $sliderId ?>" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php foreach ($post->image_srcs as $key => $src): ?>
                                                    <li data-target="#<?= $sliderId ?>"
                                                        class="<?= !$key ? 'active' : '' ?>"
                                                        data-slide-to="<?= $key ?>">
                                                <?php endforeach; ?>
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                                <?php foreach ($post->image_srcs as $key => $src): ?>
                                                    <div class="carousel-item <?= !$key ? 'active' : '' ?>">
                                                        <?= Html::img($src, ['alt' => 'Forum Post Slider Image',
                                                            'style' =>
                                                                'height:'.Post::IMAGE_HEIGHT.'px;'.
                                                                'width:'. Post::IMAGE_HEIGHT.'px;']) ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <!-- Controls -->
                                            <a class="left carousel-control" href="#<?= $sliderId ?>"
                                               data-slide="prev" role="button">
                                                <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#<?= $sliderId ?>"
                                               data-slide="next" role="button">
                                                <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                <div class="card-block">
                                    <h3 class="card-title"><?= $post->title ?></h3>
                                    <p class="card-text">
                                        <small><?= date('M d, Y', strtotime($post->date)) ?></small>
                                    </p>
                                    <p class="card-text"><?= $post->text ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-block clearfix">
                            <?= Html::a('See all (' . $post->commentsCount . ')', [
                                'forum',
                                'post_id' => $post->id,
                                'action' => 'show'
                            ], [
                                'class' => 'btn btn-outline btn-default card-link project-forum-get-replies pull-left',
                                'role' => 'button',
                                'data-loaded' => false,
                                'data-title' => 'Hide comments',
                                'data-target' => "comments-block-" . $post->id
                            ]) ?>
                            <?= Html::a('Add comment', '#', [
                                'class' => 'btn btn-outline btn-default card-link project-forum-reply pull-right',
                                'role' => 'button',
                                'data-target' => 'projectForumReply_post_' . $post->id
                            ]) ?>
                        </div>
                        <form class="comment-form"
                              id="projectForumReply_post_<?= $post->id ?>"
                              data-target="comments-block-<?= $post->id ?>"
                              action="<?= Url::to([
                                  'forum',
                                  'post_id' => $post->id,
                                  'action' => 'add'
                              ]) ?>" method="post" style="display: none;">
                            <div class="form-group">
                                <?= Html::textarea('text', false, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Comment here',
                                    'rows' => 2
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Reply</button>
                                <button type="button" class="btn btn-link blue-grey-500 comment-form-close">Close</button>
                            </div>
                        </form>
                        <div class="col-sm-12" id="comments-block-<?= $post->id ?>" style="display: none;">
<!--                            --><?//= $this->render('_reply', [
//                                'post' => $post,
//                                'index' => 0
//                            ]) ?>
                        </div>
                    </div>
                </div>
            <!-- End Widget -->
            <?php endforeach; ?>
            <?php $posts['data'] = $additionData ?>
            <?= Pagination::widget($posts) ?>
        <?php endif; ?>
        <!-- Widget -->
        <!-- End Widget -->
        </div>
    </div>
</div>

