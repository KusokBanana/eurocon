<?php

/* @var $this \yii\web\View */
use yii\helpers\Html;

/* @var $messages array */
/* @var $user \yii\web\User */
/* @var $totalCount integer */


?>

<?php if (!empty($messages)): ?>

    <?php if (count($messages) < $totalCount): ?>
        <button type="button" id="historyBtn" class="btn btn-round btn-outline btn-default">History Messages</button>
    <?php endif; ?>

    <?php $day = false; ?>
    <?php foreach ($messages as $key => $message): ?>
        <?php
            $time = strtotime($message['created_at']);
            $currentDay = date('d', $time);
            $diff = !$day || $day !== $currentDay;
            if ($diff) {
                echo '<p class="time">'.$message['when'].'</p>';
            }
            $day = $currentDay;

            // is need to open <div> block in beginning
            $closeBegin = ($diff || (isset($messages[$key-1]) && $messages[$key-1]['sender_id'] != $message['sender_id']) ||
                !isset($messages[$key-1]));

            // is need to close <div> block in end
            $closeEnd = !isset($messages[$key+1]) || (isset($messages[$key+1]) && (($messages[$key+1]['sender_id'] != $message['sender_id']) ||
                        (date('d', strtotime($messages[$key+1]['created_at'])) != $currentDay)));
        ?>
        <?= $this->render('__one_message', compact('closeBegin', 'message', 'closeEnd', 'user')) ?>
    <?php endforeach; ?>
<?php endif; ?>
