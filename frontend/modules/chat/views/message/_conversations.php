<?php
use frontend\models\Person;
use yii\helpers\Json;

/* @var $dialog \frontend\modules\chat\models\db\Conversation */
/* @var $isCurrent bool */

$date = isset($dialog['lastMessage']['created_at']) ? $dialog['lastMessage']['created_at'] : $dialog['lastMessage']['date'];
?>
<li class="conversation item list-group-item <?= ($isCurrent) ? 'active' : ''?>"
    style="padding: 15px 16px;"
    data-key="<?= $dialog['lastMessage']['id'] ?>"
    data-contact="<?= $dialog['contact']['id'] ?>"
    data-contactinfo='<?= Json::htmlEncode($dialog['contact']) ?>'
    data-unreadurl="<?= $dialog['unreadUrl'] ?>"
    data-readurl="<?= $dialog['readUrl'] ?>"
    data-deleteurl="<?= $dialog['deleteUrl'] ?>"
    data-loadurl="<?= $dialog['loadUrl'] ?>"
    data-sendurl="<?= $dialog['sendUrl'] ?>"
    data-url="<?= $dialog['loadUrl']; ?>">
    <div class="media">
        <div class="media-left">
            <a class="avatar avatar-online" href="javascript:void(0)">
                <?= \yii\helpers\Html::img(Person::getImage($dialog['contact']['image']), [
                    'class' => 'img-fluid', 'alt' => '...'
                ]) ?>
                <i></i>
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <?= $dialog['contact']['surname'] . ($dialog['contact']['surname'] ? ' ' : '') . $dialog['contact']['name']; ?>
            </h4>
            <span class="media-left"><?= mb_strimwidth($dialog['lastMessage']['text'], 0, 15, "..."); ?></span>
            <span class="media-time"><?= date('d.m H:i', strtotime($date)) ?></span>
        </div>
        <?php $count = (isset($dialog['newMessages']['count'])) ? $dialog['newMessages']['count'] :
            count($dialog['newMessages']); ?>
        <?php if ($count): ?>
            <div class="media-right p-l-0 conversation-read" title="Mark as Read">
                <span class="tag tag-pill tag-danger"><?= $count ?></span>
            </div>
        <?php endif; ?>
    </div>
</li>
