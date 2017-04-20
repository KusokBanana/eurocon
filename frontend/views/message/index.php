<?php
use bubasuma\simplechat\ConversationWidget;
use bubasuma\simplechat\MessageWidget;

/** @var $conversationDataProvider */
/** @var $user */
/** @var $current */
/** @var $messageDataProvider */
/** @var $contact */

$this->registerAssetBundle('/bubasuma/simplechat/ChatAsset');

?>


<div class="row">
    <div class="loading" style="display: none">Loading&#8230;</div>
    <?php
    $conversation = ConversationWidget::begin(
        [
            'dataProvider' => $conversationDataProvider,
            'itemView' => 'conversation',
            'options' => [
                'class' => 'conversation-wrap col-lg-3',
                'id' => 'conversations',
            ],
            'user' => $user,
            'current' => $current,
            'clientOptions' => [
                'loadUrl' => 'conversations', // TODO ??
                'baseUrl' => '', // TODO ??
                'templateUrl' => 'conversation',
                'itemCssClass' => 'conversation',
                'currentCssClass' => 'current',
                'unreadCssClass' => 'unread',
            ]
        ]
    );

    $conversation->renderItems();
    ?>
    <div id="conversations-loader" style="display: none" class="text-center">
        <img alt="Loading..." src=""/>
    </div>
    <?php

    ConversationWidget::end();

    $message = MessageWidget::begin([
        'dataProvider' => $messageDataProvider,
        'itemView' => 'message',
        'formView' => $this->context->viewPath . 'form.php',
        'user' => $user,
        'contact' => $contact,
        'options' => [
            'class' => 'message-wrap col-lg-8',
            'id' => 'messenger',
        ],
        'clientOptions' => [
            'loadUrl' => $current->loadUrl,
            'sendUrl' => $current->sendUrl,
            'sendMethod' => 'post',
            'templateUrl' => '',  // TODO ??
            'baseUrl' => '',  // TODO ??
            'container' => '#msg-container',
            'form' => '#msg-form',
            'itemCssClass' => 'msg',
        ]
    ])
    ?>

<!--    <div id="msg-container" class="msg-wrap">-->
<!--        <div id="messages-loader" style="display: none" class="text-center">-->
<!--            <img alt="Loading..." src=""/>-->
<!--        </div>-->
<!--        --><?php
//
//        $models = $message->dataProvider['models'];
//        $keys = $message->dataProvider['keys'];
//        $rows = [];
//        $when = false;
//        foreach ($models as $index => $model) {
//            if ($when != $model->when) {
//                $when = $model->when;
//                $rows[] = '<div class="alert alert-info msg-date"><strong>'.$when.'</strong></div>';
//            }
//            $rows[] = $message->renderItem($model, $keys[$index], $index);
//        }
//        echo join($message->separator, $rows);
//        ?>
<!--    </div>-->
<!---->
<!--    <div class="send-wrap ">-->
<!--        --><?//= $message->renderForm() ?>
<!--    </div>-->
<!--    <div class="btn-panel">-->
<!--        <a id="msg-send" href="" class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button">-->
<!--            <i class="fa fa-location-arrow"></i>-->
<!--            Send Message-->
<!--        </a>-->
<!--    </div>-->
    <?php MessageWidget::end(); ?>
</div>