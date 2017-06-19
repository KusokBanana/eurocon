<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="bootstrap admin template">
<meta name="author" content="">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<link rel="apple-touch-icon" href="../../web/img/layer_images/apple-touch-icon.png">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

<!--[if lt IE 9]>
<script src="../../web/vendor/html5shiv/html5shiv.min.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<script src="../../web/vendor/media-match/media.match.min.js"></script>
<script src="../../web/vendor/respond/respond.min.js"></script>
<![endif]-->

<?php $this->registerLinkTag([
    'rel' => 'shortcut icon',
    'type' => 'image/x-icon',
    'href' => Url::to('@web/favicon.ico'),
]);?>

<?php $this->registerJs('(function(document, window, $) {
            \'use strict\';
            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);') ?>
<?php $this->head() ?>