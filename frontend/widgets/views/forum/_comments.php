<?php
use frontend\widgets\Forum;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \frontend\models\Post $post */
/** @var string $index */

$comments = $post->commentaries;
?>

<?php
if (!empty($comments) && isset($comments[$index])): ?>
    <?php /** @var \frontend\models\PostComment $comment */
    foreach ($comments[$index] as $comment): ?>
        <div class="example-wrap">
            <div class="example">
                <div class="comment media">
                    <div class="media-left">
                        <?= Html::a("<div class=\"avatar ". ($comment->user->is_online ?
                                'avatar-online' : 'avatar-away') . " \">".
                            Html::img($comment->user->imageShow,
                                ['alt' => '...']) .
                            "<i></i>".
                            "</div>",
                            ['/person/profile', 'id' => $comment->user->id], ['class' => 'avatar avatar-lg']) ?>
                    </div>
                    <div class="comment-body media-body">
                        <a class="comment-author" href="javascript:void(0)"><?= $comment->user->full_name ?></a>
                        <div class="comment-meta">
                            <span class="date"><?= $comment->user->getLastAccess($comment->date); ?></span>
                        </div>
                        <div class="comment-content">
                            <p><?= $comment->text ?></p>
                        </div>
                        <div class="comment-actions">
                            <?= Html::a('Reply', '#', [
                                        'class' => 'active forum-post-reply',
                                        'role' => 'button',
                                        'data-target' => 'forumReply_'.$comment->id
                                ]) ?>
                        </div>
                        <form class="comment-form" id="forumReply_<?= $comment->id ?>"
                              data-target="comments-block-<?= $post->id ?>"
                              data-comments_count="<?= $post->commentsCount ?>"
                              action="<?= Url::to([
                                  'forum',
                                  'post_id' => $post->id,
                                  'comment_id' => $comment->id,
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

                        <?= Forum::widget([
                            'type' => Forum::$TYPE_COMMENTS,
                            'data' => $post,
                            'index' => $comment->id
                        ]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
