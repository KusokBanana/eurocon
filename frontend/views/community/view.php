<?php
/* @var $this yii\web\View */
use frontend\models\Community;
use frontend\models\Company;
use frontend\widgets\CustomModal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $community Company */
/* @var $followers array \frontend\models\Person */
/* @var $admins array \frontend\models\Person */

?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <div class="page-header h-250 " style="background-image: url(<?= Url::to('@web/img/layer_images/company-background.png') ?>);  background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-50 blue-grey-800"><?= $community->name ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Second Row -->
    <div class="col-xs-12 col-xxl-4 col-xl-4 col-lg-4">
        <div id="personalCompletedWidget" class="card card-shadow p-b-20">
            <div class="card-header card-header-transparent cover overlay">
                <?= Html::img('@web/img/portraits/placeholder.png', [
                    'class' => 'cover-image',
                ]) ?>
                <div class="overlay-panel overlay-background vertical-align" style="background-color:  #47B8C6;">
                    <div class="vertical-align-middle">
                            <?= Html::a(Html::img($community->imageShow, [
                                'title' => 'Remark'
                            ]), ["javascript:void(0)"], ['class' => 'avatar']); ?>
                        <div class="font-size-20 m-t-10"><?= $community->name ?></div>
                        <div class="font-size-14">About Construction</div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row text-xs-center m-b-20">

                    <div class="col-xs-12 ">
                        <?php if ($community->relation === Community::ROLE_ADMIN_TYPE): ?>
                            <?= Html::button('edit',
                                [
                                    'class' => 'btn btn-block btn-primary btn-outline btn-primary',
                                    'data-target' => '#community_edit',
                                    'data-toggle' => 'modal',

                                ]) ?>
                            <?= CustomModal::widget([
                                'type' => 'community_edit',
                                'model' => $community,
                                'additionalData' => [
//                                    'subscribers' => $potentialSubscribers
                                ]
                            ]) ?>
                        <?php elseif ($community->relation !== Community::ROLE_PARTICIPANT_TYPE): ?>
                            <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Follow this community',
                                ['join', 'id' => $community->id], ['class' => 'btn btn-block btn-primary']) ?>
                        <?php elseif ($community->relation === Community::ROLE_PARTICIPANT_TYPE): ?>
                            <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Unsubscribe this community',
                                ['leave', 'id' => $community->id], ['class' => 'btn btn-block btn-primary']) ?>
                        <?php endif; ?>

                        <!-- Modal body -->
                        <!-- End modal body -->
                    </div>
                </div>

                <div class="panel" id="followers">
                    <?= $this->render('_persons', [
                        'persons' => $followers,
                        'additionData' => [
                            'id' => $community->id,
                            'type' => 'followers',
                            'name' => 'Followers'
                        ]
                    ]) ?>
                </div>
                <div class="panel" id="contacts">
                    <?= $this->render('_persons', [
                        'persons' => $admins,
                        'additionData' => [
                            'id' => $community->id,
                            'type' => 'contacts',
                            'name' => 'Contacts'
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal -->
    <!-- To Do List -->
    <!-- Modal -->

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
        <div class="panel">
            <div class="row">
                <div class="col-lg-3 col-xl-3 col-xxl-3 m-t-10 m-l-10 text-xs-center">
                    <h3 class="card-title">news feed</h3>
                </div>
                <div class="col-lg-7 col-xl-7 col-xxl-7 m-t-20 m-l-15">
                    <div class="form-group">
                        <div class="input-search">
                            <i class="input-search-icon wb-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" name="" placeholder="Search...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content container-fluid">
                <div class="row" data-plugin="masonry" style="position: relative; height: 2925.13px;">
                    <div class="col-xs-12 col-lg-12 col-sm-12 masonry-item" style="position: absolute; left: 0px; top: 0px;">
                        <!-- Widget -->
                        <div class="card card-shadow">
                            <div class="row">
                                <div class="col-xs-3 col-lg-3 col-sm-3">
                                    <div class="card-img-top cover overlay overlay-hover">
                                        <img class="cover-image overlay-figure overlay-scale" src="../../global/photos/placeholder.png" alt="">
                                    </div>
                                </div>
                                <div class="col-xs-9 col-lg-9 col-sm-9">
                                    <div class="card-block">
                                        <h3 class="card-title">Possumus fugiendum verborum</h3>
                                        <p class="card-text">
                                            <small>Jan 16, 2017</small>
                                        </p>
                                        <p class="card-text">Munere dictum dissentio dicturam mediocriterne honesta, morbi delectus
                                            rationibus periculum opinor propterea intuemur poetarum efficeretur
                                            interpretaris, labefactant aeternum reformidans, laborum inquit
                                            laus. Dolor fana conficiuntque efficerent persequeris quos dicas
                                            essent. Aristippus tollunt nollem clamat similique corpore gerendarum
                                            quas initiis, possum. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block clearfix">
                                <a class="btn btn-outline btn-default card-link" href="javascript:void(0)">Comments</a>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-xs-center m-t-30">
                                    <button class="btn btn-outline btn-primary" type="button" name="button">See all (19)</button>
                                </div>
                                <!-- Example Reply Form -->
                                <div class="example-wrap">
                                    <div class="example">
                                        <div class="comment media">
                                            <div class="media-left">
                                                <a class="avatar avatar-lg" href="javascript:void(0)">
                                                    <img src="../../global/portraits/4.jpg" alt="...">
                                                </a>
                                            </div>
                                            <div class="comment-body media-body">
                                                <a class="comment-author" href="javascript:void(0)">June Lane</a>
                                                <div class="comment-meta">
                                                    <span class="date">5 days ago</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>Dude, this is awesome. Thanks so much</p>
                                                </div>
                                                <div class="comment-actions">
                                                    <a class="active" href="javascript:void(0)" role="button">Reply</a>
                                                </div>
                                                <form class="comment-reply" action="#" method="post">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="2" placeholder="Comment here"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Reply</button>
                                                        <button type="button" class="btn btn-link blue-grey-500">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Example Avatar -->
                            </div>
                        </div>
                        <!-- End Widget -->
                    </div>
                    <div class="col-xs-12 col-lg-12 col-sm-12 masonry-item" style="position: absolute; left: 440px; top: 0px;">
                        <!-- Widget With Carousel -->
                        <div class="card card-shadow">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <div class="card-img-top cover">
                                    <div class="cover-gallery carousel slide" id="exampleCoverGallery" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li class="" data-target="#exampleCoverGallery" data-slide-to="0"></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="1" class=""></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="2" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item">
                                                <img alt="First slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item">
                                                <img alt="Second  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item active">
                                                <img alt="Third  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                        </div>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#exampleCoverGallery" data-slide="prev" role="button">
                                            <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#exampleCoverGallery" data-slide="next" role="button">
                                            <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                <div class="card-block">
                                    <h3 class="card-title">Expleantur manu graecam</h3>
                                    <p class="card-text">
                                        <small>Feb 21, 2017</small>
                                    </p>
                                    <p class="card-text">Adiungimus acutum iudicatum aliud aegritudinem, tritani ignavi incidant
                                        quaeritur transferrem loqueretur delectatio, appetere, eruditi.
                                        Eamque quaeso diuturnum. Atomis quietae quamquam cadere arbitrantur
                                        magnam referuntur utramque aristippi, filium eidola, iudicat veniamus,
                                        noctesque invenerit, alia factorum aristoteli phaedrum parta quicquid
                                        morbi animadversionem. </p>
                                </div>
                            </div>
                            <div class="card-block clearfix">
                                <a class="btn btn-outline btn-default card-link" href="javascript:void(0)">Comments</a>
                            </div>
                        </div>
                        <!-- End Widget With Carousel -->
                    </div>
                    <div class="col-xs-12 col-lg-12 col-sm-12 masonry-item" style="position: absolute; left: 440px; top: 0px;">
                        <!-- Widget With Carousel -->
                        <div class="card card-shadow">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <div class="card-img-top cover">
                                    <div class="cover-gallery carousel slide" id="exampleCoverGallery" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li class="" data-target="#exampleCoverGallery" data-slide-to="0"></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="1" class=""></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="2" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item">
                                                <img alt="First slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item">
                                                <img alt="Second  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item active">
                                                <img alt="Third  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                        </div>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#exampleCoverGallery" data-slide="prev" role="button">
                                            <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#exampleCoverGallery" data-slide="next" role="button">
                                            <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                <div class="card-block">
                                    <h3 class="card-title">Expleantur manu graecam</h3>
                                    <p class="card-text">
                                        <small>Feb 21, 2017</small>
                                    </p>
                                    <p class="card-text">Adiungimus acutum iudicatum aliud aegritudinem, tritani ignavi incidant
                                        quaeritur transferrem loqueretur delectatio, appetere, eruditi.
                                        Eamque quaeso diuturnum. Atomis quietae quamquam cadere arbitrantur
                                        magnam referuntur utramque aristippi, filium eidola, iudicat veniamus,
                                        noctesque invenerit, alia factorum aristoteli phaedrum parta quicquid
                                        morbi animadversionem. </p>
                                </div>
                            </div>
                            <div class="card-block clearfix">
                                <a class="btn btn-outline btn-default card-link" href="javascript:void(0)">Comments</a>
                            </div>
                        </div>
                        <!-- End Widget With Carousel -->
                    </div>
                    <div class="col-xs-12 col-lg-12 col-sm-12 masonry-item" style="position: absolute; left: 440px; top: 0px;">
                        <!-- Widget With Carousel -->
                        <div class="card card-shadow">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <div class="card-img-top cover">
                                    <div class="cover-gallery carousel slide" id="exampleCoverGallery" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li class="" data-target="#exampleCoverGallery" data-slide-to="0"></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="1" class=""></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="2" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item">
                                                <img alt="First slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item">
                                                <img alt="Second  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item active">
                                                <img alt="Third  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                        </div>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#exampleCoverGallery" data-slide="prev" role="button">
                                            <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#exampleCoverGallery" data-slide="next" role="button">
                                            <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                <div class="card-block">
                                    <h3 class="card-title">Expleantur manu graecam</h3>
                                    <p class="card-text">
                                        <small>Feb 21, 2017</small>
                                    </p>
                                    <p class="card-text">Adiungimus acutum iudicatum aliud aegritudinem, tritani ignavi incidant
                                        quaeritur transferrem loqueretur delectatio, appetere, eruditi.
                                        Eamque quaeso diuturnum. Atomis quietae quamquam cadere arbitrantur
                                        magnam referuntur utramque aristippi, filium eidola, iudicat veniamus,
                                        noctesque invenerit, alia factorum aristoteli phaedrum parta quicquid
                                        morbi animadversionem. </p>
                                </div>
                            </div>
                            <div class="card-block clearfix">
                                <a class="btn btn-outline btn-default card-link" href="javascript:void(0)">Comments</a>
                            </div>
                        </div>
                        <!-- End Widget With Carousel -->
                    </div>
                    <div class="col-xs-12 col-lg-12 col-sm-12 masonry-item" style="position: absolute; left: 440px; top: 0px;">
                        <!-- Widget With Carousel -->
                        <div class="card card-shadow">
                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                <div class="card-img-top cover">
                                    <div class="cover-gallery carousel slide" id="exampleCoverGallery" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li class="" data-target="#exampleCoverGallery" data-slide-to="0"></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="1" class=""></li>
                                            <li data-target="#exampleCoverGallery" data-slide-to="2" class="active"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item">
                                                <img alt="First slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item">
                                                <img alt="Second  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                            <div class="carousel-item active">
                                                <img alt="Third  slide" src="../../global/photos/placeholder.png">
                                            </div>
                                        </div>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#exampleCoverGallery" data-slide="prev" role="button">
                                            <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#exampleCoverGallery" data-slide="next" role="button">
                                            <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                <div class="card-block">
                                    <h3 class="card-title">Expleantur manu graecam</h3>
                                    <p class="card-text">
                                        <small>Feb 21, 2017</small>
                                    </p>
                                    <p class="card-text">Adiungimus acutum iudicatum aliud aegritudinem, tritani ignavi incidant
                                        quaeritur transferrem loqueretur delectatio, appetere, eruditi.
                                        Eamque quaeso diuturnum. Atomis quietae quamquam cadere arbitrantur
                                        magnam referuntur utramque aristippi, filium eidola, iudicat veniamus,
                                        noctesque invenerit, alia factorum aristoteli phaedrum parta quicquid
                                        morbi animadversionem. </p>
                                </div>
                            </div>
                            <div class="card-block clearfix">
                                <a class="btn btn-outline btn-default card-link" href="javascript:void(0)">Comments</a>
                            </div>
                        </div>
                        <!-- End Widget With Carousel -->
                    </div>
                    <!-- Widget -->
                    <!-- End Widget -->
                </div>
            </div>
        </div>
        <nav>
            <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
        </nav>
    </div>


</div>

