<?php
use frontend\models\MarketplaceItem;
use yii\helpers\Html;

?>

<?php
if (!empty($items['data'])): ?>
    <div class="card">
        <div class="card-header card-header-transparent p-20">
            <h3 class="card-title m-b-0 center">Marketplace</h3>
        </div>
        <div class="row p-l-30 p-r-30">
            <?php /** @var MarketplaceItem $item */
            foreach ($items['data'] as $item): ?>
                <?php $item = $item->item; ?>
                <div class="col-sm-6 col-xs-6 m-b-20">
                    <?= Html::img($item->imageShow, ['width' => '100%', 'height' => '100%']) ?>
                    <h4 class="font-size-16 m-b-5"><?= $item->name ?></h4>
                    <span>
                        <?= Html::a('See more', ['/marketplace/view', 'id' => $item->id]) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>