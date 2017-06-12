<?php
use frontend\models\Person;
use yii\helpers\Html;

/* @var $message \frontend\modules\chat\models\Message*/
/* @var $user \yii\web\User */
/* @var $closeBegin bool */
/* @var $closeEnd bool */

$isMe = ($message['sender_id'] == $user['id']);

$closeBegin = isset($closeBegin) ? $closeBegin : true;
$closeEnd = isset($closeEnd) ? $closeEnd : true;
?>

<?php if ($closeBegin): ?>
    <div class="chat msg <?= !$isMe ? 'chat-left' : '' ?>">
    <div class="chat-avatar">
        <?= Html::a(Html::img(Person::getImage($message['sender']['image']), []), '#', [
            'class' => 'avatar',
            'data-toggle' => 'tooltip',
            'data-placement' => $isMe ? 'right' : 'left',
            'title' => ''
        ]) ?>
        <div class="media-time"><?= $message['date'] ?></div>
    </div>
    <div class="chat-body">
<?php endif; ?>
    <div class="chat-content"
         data-when="<?= $message['when'] ?>"
         data-key="<?= $message['id'] ?>">
        <p><?= $message['text']; ?></p>
    </div>
<?php if ($closeEnd): ?>
    </div>
    </div>
<?php endif; ?>