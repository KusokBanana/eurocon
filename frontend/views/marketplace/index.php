<?php
use frontend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $marketplaceItems \frontend\models\MarketplaceItem */
/* @var $this \yii\web\View */

//$this->registerJsFile('@web/js/Plugin/animate-list.min.js', ['depends' => [AppAsset::className()]]);
$this->params['body-class'] = 'app-media page-aside-left site-menubar-hide';
?>


<div class="page-header h-300 m-b-30"
     style="background-image: url(<?= Url::to('@web/img/layer_images/marketplace-background.png') ?>);
            background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
        <div class="font-size-70 m-b-30 blue-grey-800">Marketplace</div>

    </div>
</div>

<div class="page bg-white">
    <!-- Media Sidebar -->

    <!-- Media Content -->
    <div class="page-main" id="marketplace">
        <!-- Media Content Header -->

        <?= $this->render('_items', [
            'items' => $marketplaceItems,
            'additionData' => []
        ]) ?>

    </div>
</div>
