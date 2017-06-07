<?php
use frontend\models\Post;
use frontend\widgets\Forum;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\web\View $this */
/** @var \frontend\models\AjaxReload $posts */

?>
<div class="panel">
    <div class="row">
        <div class="col-lg-8 col-xl-8 col-xxl-8 m-t-20 m-l-15">
            <div class="form-group">
                    <?= Search::widget([
                        'extraData' => $posts->joinExtraData([
                            'placeholder' => 'Find post...'
                        ])->extraData,
                        'query' => $posts->getSearch(),
                        'data' => $posts->data,
                        'type' => $posts->type,
                        'wrapSelector' => '#forum'
                    ]) ?>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 col-xxl-3 m-t-20 m-l-20 text-xs-center">
            <?= Html::button('Add post',
                [
                    'class' => 'btn btn-outline btn-primary',
                    'data-target' => '#'.Forum::$FORUM_MODAL_ADD_POST_ID,
                    'data-toggle' => 'modal',

                ]) ?>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <?php if (!empty($posts->data)): ?>
            <?php /** @var Post $post */
            foreach ($posts->data as $post): ?>
                <div class="col-xs-12 col-lg-12 col-sm-12 forum-post"
                    <!-- Widget -->
                    <div class="card card-shadow">
                        <div class="row">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <?php if (count($post->image_srcs) > 1): ?>
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
                                <?php elseif (count($post->image_srcs) == 1): ?>
                                    <div class="card-img-top cover">
                                        <div class="row">
                                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                                <?= Html::img($post->image_srcs[0], ['alt' => 'Forum Post Image',
                                                    'style' =>
                                                        'height:'.Post::IMAGE_HEIGHT.'px;'.
                                                        'width:'. Post::IMAGE_HEIGHT.'px;']) ?>
                                            </div>
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
                                'class' => 'btn btn-outline btn-default card-link forum-get-replies pull-left forum-see-all',
                                'role' => 'button',
                                'data-comments_count' => $post->commentsCount,
                                'data-loaded' => false,
                                'data-title' => 'Hide comments',
                                'data-target' => "comments-block-" . $post->id
                            ]) ?>
                            <?= Html::a('Add comment', '#', [
                                'class' => 'btn btn-outline btn-default card-link forum-post-reply pull-right',
                                'role' => 'button',
                                'data-target' => 'forumReply_post_' . $post->id
                            ]) ?>
                        </div>
                        <form class="comment-form"
                              id="forumReply_post_<?= $post->id ?>"
                              data-comments_count="<?= $post->commentsCount ?>"
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
            <?= Pagination::widget($posts->pagination) ?>
        <?php endif; ?>
        <!-- Widget -->
        <!-- End Widget -->
        </div>
    </div>
</div>

