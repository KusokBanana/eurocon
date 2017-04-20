<?php
/* @var $participants \frontend\models\Person array*/
use yii\helpers\Html;

?>

<?php if (!empty($participants)): ?>
    <ul class="list-group">
        <?php foreach ($participants as $participant): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <div class="avatar <?= $participant->is_online ?
                            'avatar-online' : 'avatar-away'; ?>">
                            <?= Html::img($participant->image,
                                ['alt' => '...']) ?>
                            <i></i>
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?= $participant->name ?>
                            <small>Last Access: <?= $participant->last_access ?></small>
                        </h4>
                        <p>
                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                            Street 4190 W Lone Mountain Rd
                        </p>
                        <div>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="media-right">
                        <button type="button" class="btn btn-outline btn-success btn-sm">Follow</button>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <nav>
        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border">
            <li class="pagination-prev page-item disabled">
                <a class="page-link" href="javascript:void(0)" aria-label="Prev">
                    <span class="icon wb-chevron-left-mini"></span>
                </a>
            </li>
            <li class="pagination-items page-item active" data-value="1">
                <a class="page-link" href="javascript:void(0)">1</a>
            </li>
            <li class="pagination-items page-item" data-value="2">
                <a class="page-link" href="javascript:void(0)">2</a>
            </li>
            <li class="pagination-items page-item" data-value="3">
                <a class="page-link" href="javascript:void(0)">3</a>
            </li>
            <li class="pagination-items page-item" data-value="4">
                <a class="page-link" href="javascript:void(0)">4</a>
            </li>
            <li class="pagination-items page-item" data-value="5">
                <a class="page-link" href="javascript:void(0)">5</a>
            </li>
            <li class="pagination-next page-item">
                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                    <span class="icon wb-chevron-right-mini"></span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>