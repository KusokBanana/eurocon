<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $conversations array */
/* @var $new integer */

?>

<a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
   id="miniChatLink" aria-expanded="false" data-animation="scale-up" role="button">
    <i class="icon wb-chat" aria-hidden="true"></i>
    <span class="tag tag-pill tag-info up" style="<?= !$new ? 'display:none;' : '' ?>">
        <span class="mini-chat-count"><?= $new ?></span>
    </span>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-media" id="miniChat" role="menu">
    <div class="dropdown-menu-header">
        <h5>Messages</h5>
        <span class="tag tag-round tag-danger" style="<?= !$new ? 'display:none;' : '' ?>">
            New <span class="mini-chat-count"><?= $new ?></span>
        </span>
    </div>
    <div class="list-group">
        <div data-role="container">
            <div data-role="content" class="mini-chat-content">
                <?php if (!empty($conversations)): ?>
                    <?= $this->render('_items', ['conversations' => $conversations]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="dropdown-menu-footer">
        <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
            <i class="icon md-settings" aria-hidden="true"></i>
        </a>
        <?= Html::a('All Messages', ['/messages'], ['class' => 'dropdown-item', 'role' => 'menuitem']) ?>
    </div>
</div>
