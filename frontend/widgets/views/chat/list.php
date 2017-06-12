<?php

/* $dialogs array */

?>


<?php if (!empty($dialogs)): ?>
    <?php foreach ($dialogs as $dialog): ?>
        <a class="list-group-item" href="javascript:void(0)" data-toggle="show-chat">
            <div class="media">
                <div class="media-left">
                    <div class="avatar avatar-sm avatar-away">
                        <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="..." />
                        <i></i>
                    </div>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Mary Adams</h4>
                    <small>I am superman</small>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>
