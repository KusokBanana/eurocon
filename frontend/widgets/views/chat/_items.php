<?php

/* @var $conversations array */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (!empty($conversations)): ?>
    <?php /** @var \frontend\modules\chat\models\db\Conversation $conversation */
    foreach ($conversations as $conversation): ?>
        <a class="list-group-item dropdown-item"
           href="<?= Url::to(['/messages/'.$conversation->contact_id]) ?>"
           role="menuitem">
            <div class="media">
                <div class="media-left p-r-10">
                    <?= Html::img($conversation->contact->imageShow, ['width' => '35px']) ?>
                </div>
                <div class="media-body">
                    <h6 class="media-heading"><?= mb_strimwidth($conversation->lastMessage->text, 0, 70, "...") ?></h6>
                    <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">
                        <?= date('d.m H:s', strtotime($conversation->lastMessage->created_at)) ?>
                    </time>
                    <?php if (+$conversation->new): ?>
                        <span class="tag tag-round tag-danger">new</span>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>
