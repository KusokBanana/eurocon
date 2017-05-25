<?php
use frontend\assets\AppAsset;
use frontend\models\Project;
use frontend\models\ProjectTimeline;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/** @var \yii\web\View $this */
/** @var Project $project */
/** @var ProjectTimeline $timelines */


//$this->registerJsFile('@web/vendor/jquery-ui/jquery-ui.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-tmpl/tmpl.min.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-canvas-to-blob/canvas-to-blob.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-load-image/load-image.all.min.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-file-upload/jquery.fileupload.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-file-upload/jquery.fileupload-process.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-file-upload/jquery.fileupload-image.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/blueimp-file-upload/jquery.fileupload-video.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/dropify/dropify.min.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/js/Plugin/dropify.min.js',  ['depends' => [AppAsset::className()]]);
//$this->registerJsFile('@web/vendor/forms/uploads.js',  ['depends' => [AppAsset::className()]]);
//
//$this->registerCssFile('@web/vendor/dropify/dropify.min.css');
//$this->registerCssFile('@web/vendor/blueimp-file-upload/jquery.fileupload.min.css');

?>

<ul class="list-group">
    <div class="text-xs-center m-t-50">

        <?php if ($project->relation === Project::RELATION_ADMIN): ?>
            <?= Html::a('Add new', ['timeline', 'id' => 0, 'project_id' => $project->id],
                [
                    'class' => 'btn btn-lg btn-outline btn-primary m-r-10 timeline-edit',
                    'data-type' => 'new'
                ]) ?>
            <?= Html::button('Edit',
                [
                    'class' => 'btn btn-lg btn-outline btn-primary m-l-10 timeline-edit',
                    'data-type' => 'activate'
                ]) ?>
        <?php elseif ($project->relation === Project::RELATION_PARTICIPANT): ?>
            <?= Html::a('Request new', ['timeline', 'id' => 0, 'project_id' => $project->id],
                [
                    'class' => 'btn btn-lg btn-outline btn-primary m-r-10 timeline-edit',
                    'data-type' => 'request'
                ]) ?>
        <?php endif; ?>

    </div>
    <li class="list-group-item">

        <div class="page-content container">
            <!-- Timeline -->
            <ul class="timeline timeline-simple">
                <?php $month = ''; ?>
                <?php $colors = ['', 'bg-green-500', 'bg-orange-600']; ?>
                <?php foreach ($timelines as $key => $timeline): ?>
                    <?php if (!$timeline->is_active) continue; ?>

                    <?php if (($month && $month != date('m', strtotime($timeline->date))) ||
                        (!$month && $key == count($timeline) - 1)): ?>
                        <li class="timeline-period"><?= strtoupper(date('F Y', strtotime($timeline->date))); ?></li>
                    <?php endif; ?>
                    <?php
                    $month = date('m', strtotime($timeline->date));
                    $num_days = ceil((time() - strtotime($timeline->date))/86400);
                    $when = ($num_days) ? ($num_days == 1 ? 'Yesterday' : $num_days . ' Days ago') : 'Today';
                    ?>

                    <li class="timeline-item <?= ($key%2) ? 'timeline-reverse' : ''; ?>">
                        <div class="timeline-dot <?= next($colors) ?>" data-placement="<?= ($key%2) ? 'left' : 'right'; ?>"
                             data-toggle="tooltip"
                             data-trigger="hover" data-original-title="<?= $when  ?>"></div>

                        <?php if ($project->relation === Project::RELATION_ADMIN): ?>
                            <div class="timeline-info tool-container tool-top toolbar-dark animate-standard"
                                 style="display: none;">
                                <div class="tool-items">
                                    <?= Html::a('<i class="icon wb-edit" aria-hidden="true"></i>',
                                        ['timeline', 'id' => $timeline->id, 'project_id' => $timeline->project_id],
                                        [
                                            'class' => 'timeline-edit tool-item',
                                            'data-type' => 'edit',
                                            'style' => 'color: black;',

                                        ]) ?>
                                    <?= Html::a('<i class="icon wb-trash" aria-hidden="true"></i>',
                                        ['timeline', 'id' => $timeline->id, 'project_id' => $timeline->project_id],
                                        [
                                            'class' => 'timeline-edit tool-item',
                                            'data-type' => 'delete',
                                            'style' => 'color: black;',

                                        ]) ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="timeline-content">
                            <div class="card card-shadow">

                                <?php if ($timeline->media_type_id == ProjectTimeline::MEDIA_TYPE_IMAGE &&
                                    !empty($timeline->image_srcs)): ?>
                                    <div class="card-img-top cover">
                                        <?php if (count($timeline->image_srcs) > 1): ?>
                                            <div class="cover-gallery carousel slide" id="exampleCoverGallery"
                                                 data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php foreach ($timeline->image_srcs as $keyImage => $image_src): ?>
                                                        <li class="<?= (!$keyImage ? 'active' : '') ?>"
                                                            data-target="#exampleCoverGallery"
                                                            data-slide-to="<?= $keyImage ?>"></li>
                                                    <?php endforeach; ?>
                                                </ol>
                                                <div class="carousel-inner" role="listbox">
                                                    <?php foreach ($timeline->image_srcs as $keyImage => $image_src): ?>
                                                        <div class="carousel-item <?= (!$keyImage ? 'active' : '') ?>">
                                                            <?= Html::img($image_src, ['alt' => 'slide-'.$keyImage]) ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                    <!-- Controls -->
                                                <a class="left carousel-control" href="#exampleCoverGallery"
                                                   data-slide="prev"
                                                       role="button">
                                                        <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                <a class="right carousel-control" href="#exampleCoverGallery" data-slide="next"
                                                       role="button">
                                                        <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                            </div>
                                        <?php else: ?>
                                            <?= Html::img($timeline->image_srcs[0], ['alt' => 'slide']) ?>
                                        <?php endif; ?>
                                    </div>
                                <?php elseif ($timeline->media_type_id == ProjectTimeline::MEDIA_TYPE_VIDEO): ?>
                                    <div class="card-header cover player p-0" data-plugin="plyr">
                                        <video poster="../../assets/examples/images/poster.jpg" controls crossorigin>
                                            <!-- Video Files -->
                                            <source type="video/mp4" src="https://cdn.selz.com/plyr/1.0/movie.mp4">
                                            <source type="video/webm" src="https://cdn.selz.com/plyr/1.0/movie.webm">
                                            <!-- Text Track File -->
                                            <track kind="captions" label="English" srclang="en" src="//cdn.selz.com/plyr/1.0/en.vtt"
                                                   default>
                                            <!-- Fallback For Browsers That Don'T Support The <Video> Element -->
                                            <a href="https://cdn.selz.com/plyr/1.0/movie.mp4">Download</a>
                                        </video>
                                    </div>
                                <?php endif; ?>

                                <div class="card-block p-30">
                                    <h3 class="card-title"><?= $timeline->title; ?></h3>
                                    <p class="card-text">
                                        <small><?= strtoupper(date('F d, Y', strtotime($timeline->date))); ?></small>
                                    </p>
                                    <p><?= $timeline->text; ?></p>
                                </div>
                                <div class="card-block">
                                    <!--                                <a class="btn btn-primary btn-outline card-link" href="javascript:void(0)">Read More</a>-->
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                <li class="timeline-period">MAY 2017</li>
                <li class="timeline-item">
                    <div class="timeline-dot" data-placement="right" data-toggle="tooltip"
                         data-trigger="hover" data-original-title="2 Days ago"></div>
                    <div class="timeline-content">
                        <div class="card card-shadow">
                            <div class="card-img-top cover">
                                <img class="cover-image" src="https://turbo.network/hqroom/image/upload/c_limit,f_auto,h_10000,w_1600/v1488356661/post/337aa063fb17274cd05d1954/3cf2e8af707bf250rGMx2HeQEbamnr9U.jpg" alt="...">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-reverse">
                    <div class="timeline-dot bg-green-500" data-placement="left" data-toggle="tooltip"
                         data-trigger="hover" data-original-title="2 Days ago"></div>
                    <div class="timeline-content">
                        <div class="card card-shadow">
                            <div class="card-img-top cover">
                                <img class="cover-image" src="https://turbo.network/hqroom/image/upload/c_limit,f_auto,h_10000,w_1600/v1488356658/post/337aa063fb17274cd05d1954/f085de7cf5b50feeJBCFibXc253i0NGq.jpg" alt="...">
                            </div>
                            <div class="card-block p-30">
                                <h3 class="card-title">Lorem Ipsum Dolor</h3>
                                <p class="card-text">
                                    <small>MAY 15, 2017</small>
                                </p>
                                <p>Dubium sequatur declinare fecit securi emolumento ait habere tutiorem
                                    neglegentur, pugnantibus simplicem propemodum atqui suo licet
                                    confirmat. Iudicium ipso debent panaetium exorsus, vacuitate
                                    artifex confirmavit asperner posuit sollicitant contentam probamus
                                    perdiderunt. Coniuncta appetendi quo operis, iniucundus, putat
                                    magnis, invitat diceret. </p>
                            </div>
                            <div class="card-block">
<!--                                <a class="btn btn-primary btn-outline card-link" href="javascript:void(0)">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item">
                    <div class="timeline-dot bg-orange-500" data-placement="right" data-toggle="tooltip" data-trigger="hover" data-original-title="9 Days ago"></div>
                    <div class="timeline-content">
                        <div class="card card-shadow">
                            <div class="card-header cover">
                                <div class="cover-background p-30" style="background-image: url('https://www.firestock.ru/wp-content/uploads/2013/08/firestock_dark_Leather_06082013-1024x1024.jpg')">
                                    <blockquote class="blockquote cover-quote white card-blockquote">Fabulis timentis synephebos faciendum laetitia utamur consuevit
                                        tali hortatore videre, summa quasi, consequentis desideret.
                                        Constantia aptior consectetur credo audiebamus dissentiunt
                                        vivere moribus. </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-period">Apr 2017</li>
                <li class="timeline-item">
                    <div class="timeline-dot bg-green-500 animation-scale-up" data-placement="right" data-toggle="tooltip" data-trigger="hover" data-original-title="1 Month ago"></div>
                    <div class="timeline-content animation-slide-left">
                        <div class="card card-shadow">
                            <div class="card-img-top cover">
                                <img class="cover-image" src="https://turbo.network/hqroom/image/upload/c_limit,f_auto,h_10000,w_1600/v1488356657/post/337aa063fb17274cd05d1954/32db6a5687b8e0d9Issj8K6CwgOFi0QE.jpg" alt="...">
                            </div>
                            <div class="card-block">
                                <h3 class="card-title">Lorem Ipsum Dolor</h3>
                                <p class="card-text">
                                    <small>MAY 08, 2017</small>
                                </p>
                                <p>Sumus homo praetor intellegerem erga incidunt singulis, legam viveremus
                                    deorum, tertio frui tantum dedocendi profecto omittantur gravissimas
                                    cognitioque. Arbitrer negarent vocant disserui urbanitas, videtis
                                    commenticiam persequeris recteque data amoris opes. Discenda
                                    efficere diligi praesenti nostri adversantur pertinaces detractis
                                    levitatibus etiam. </p>
                            </div>
                            <div class="card-block">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-item timeline-reverse">
                    <div class="timeline-dot bg-orange-600 animation-scale-up" data-placement="left" data-toggle="tooltip" data-trigger="hover" data-original-title="1 Month ago"></div>
                    <div class="timeline-content animation-slide-right">
                        <div class="card card-shadow">
                            <div class="card-header cover">
                                <div class="cover-background p-30" style="background-image: url('https://www.firestock.ru/wp-content/uploads/2013/08/firestock_dark_Leather_06082013-1024x1024.jpg')">
                                    <blockquote class="blockquote cover-quote white card-blockquote">Debilitati fugienda partitio esse debemus, erat segnitiae quaerimus
                                        iudicia aspernatur vis, perfunctio quae ludus commodius habemus
                                        inflammat. Distinguantur vera a tollatur desiderent. </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
            <!-- End Timeline -->
        </div>
    </li>
</ul>
