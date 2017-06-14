<?php

/* @var $this \yii\web\View */
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $conversationDataProvider array */
/* @var $messageDataProvider array */
/* @var $current \frontend\modules\chat\models\Conversation */
/* @var $contact array */
/* @var $user array */

$this->params['body-class'] = 'app-message page-aside-scroll page-aside-left site-menubar-hide';

$this->registerJsFile('@web/js/chat/yiiSimpleChat.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/chat/yiiSimpleChatConversations.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/chat/yiiSimpleChatMessages.js', ['depends' => [AppAsset::className()]]);

$options = Json::htmlEncode([
        'loadUrl' => Url::to(['conversations']),
//        'baseUrl' : asset.baseUrl,
        'renderUrl' => Url::to(['render-view'/*, 'view' => 'conversation'*/]),
        'templateUrl' => '_conversations',
        'itemCssClass' => 'conversation',
        'currentCssClass' => 'active',
//        'unreadCssClass' : 'unread',
]);
$userJs = Json::htmlEncode($user);
$currentJs = Json::htmlEncode($current);
$this->registerJs("jQuery('#conversations').yiiSimpleChatConversations($userJs, $currentJs, $options);");

$contactJs = Json::htmlEncode($contact);
$options = Json::htmlEncode([
        'loadUrl' => $current['loadUrl'],
        'sendUrl' => $current['sendUrl'],
        'renderUrl' => Url::to(['render-view']),
//        'baseUrl' : asset.baseUrl,
        'sendMethod' => 'post',
        'templateUrl' => '__one_message',
        'container' => '#msg-container',
        'form' => '#msg-form',
        'itemCssClass' => 'msg',
    ]);
$this->registerJs("jQuery('#messages').yiiSimpleChatMessages($userJs, $contactJs, $options);");

?>

<div class="page">

    <div style="">

    </div>

    <!-- Message Sidebar -->
    <div class="page-aside">
        <div class="page-aside-switch">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
            <i class="icon wb-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="page-aside-inner">
<!--            <div class="input-search">--> <!-- TODO add here search for conversations -->
<!--                <button class="input-search-btn" type="submit">-->
<!--                    <i class="icon wb-search" aria-hidden="true"></i>-->
<!--                </button>-->
<!--                <form>-->
<!--                    <input class="form-control" type="text" placeholder="Search Keyword" name="">-->
<!--                </form>-->
<!--            </div>-->
            <div class="app-message-list page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        <ul class="list-group" id="conversations">
                            <?php if (!empty($conversationDataProvider['models'])): ?>
                                <?php foreach ($conversationDataProvider['models'] as $dialog): ?>
                            <?= $this->render('_conversations', ['dialog' => $dialog,
                                'isCurrent' => $dialog['contact_id'] == $current['contact']['id']]) ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div id="conversations-loader" style="display: none" class="text-center">
                            <?= Html::img('@web/img/layer_images/inf-square-loader.gif', ['alt' => 'Loading...']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Message Sidebar -->
    <div class="page-main">
        <!-- Chat Box -->
        <div class="app-message-chats" id="messages">
            <div class="chats" id="msg-container">
                <?php $messagesArr = $messageDataProvider->toArray(); ?>
                <?= $this->render('_messages',
                    [
                        'messages' => array_reverse($messagesArr['models']),
                        'user' => $user,
                        'totalCount' => $messagesArr['totalCount']
                    ]) ?>
            </div>
            <div id="messages-loader" style="display: none" class="text-center">
                <?= Html::img('@web/img/layer_images/inf-circle-loader.gif', ['alt' => 'Loading...']) ?>
            </div>
        </div>
        <!-- End Chat Box -->
        <!-- Message Input-->

        <form class="app-message-input" id="msg-form">
            <div class="message-input">
                <textarea class="form-control" id="msg-input" name="text" rows="1"></textarea>
<!--                <div class="message-input-actions btn-group">--><!-- TODO add here smiles and images -->
<!--                    <button class="btn btn-pure btn-icon btn-default" type="button">-->
<!--                        <i class="icon wb-emoticon" aria-hidden="true"></i>-->
<!--                    </button>-->
<!--                    <button class="btn btn-pure btn-icon btn-default" type="button">-->
<!--                        <i class="icon wb-image" aria-hidden="true"></i>-->
<!--                    </button>-->
<!--                    <button class="btn btn-pure btn-icon btn-default" type="button">-->
<!--                        <i class="icon wb-paperclip" aria-hidden="true"></i>-->
<!--                    </button>-->
<!--                    <input id="messageImage" type="file" name="messageImage">-->
<!--                    <input id="messageFile" type="file" name="messageFile">-->
<!--                </div>-->
            </div>
            <button class="message-input-btn btn btn-primary" type="button" id="msg-send">SEND</button>
        </form>
        <!-- End Message Input-->
    </div>
</div>
