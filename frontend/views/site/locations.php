<?php

use frontend\assets\AppAsset;
use frontend\assets\LocationsAsset;
use frontend\models\Location;
use frontend\models\MarketplaceItem;
use frontend\models\Project;
use frontend\models\Tag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $projects array \frontend\models\Project */
/* @var $companies array \frontend\models\Company */
/* @var $persons array \frontend\models\Person */
/* @var $tags array  */

LocationsAsset::register($this);

$this->params['body-class'] = 'app-travel';
$this->registerCssFile('@web/vendor/switchery/switchery.min.css');
?>

<div class="page-header h-300 m-b-30"
     style="background-image: url(<?= Url::to('@web/img/layer_images/locations-background.png') ?>);
     background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
        <div class="font-size-70 m-b-30 blue-grey-800" style="background-color: rgba(232, 241, 248, 0.7);">Locations</div>
    </div>
</div>

<!-- Page -->
<div class="page">

    <!-- Travel Options Siderbar -->
    <div class="page-aside">

<!--        <div class="page-aside-switch">-->
<!--            <i class="icon wb-chevron-left" aria-hidden="true"></i>-->
<!--            <i class="icon wb-chevron-right" aria-hidden="true"></i>-->
<!--        </div>-->

        <div class="page-aside-inner nav-tabs-animate">
            <div class="page-nav-tabs">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-toggle="tab" href="#projects" aria-controls="travel-spots"
                           aria-expanded="false" role="tab">Projects</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#companies" aria-controls="travel-hotels"
                           aria-expanded="true" role="tab">Companies</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-toggle="tab" href="#persons" aria-controls="travel-reviews"
                           aria-expanded="false" role="tab">Persons</a>
                    </li>
                </ul>
            </div>
            <div class="page-aside-content page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        <div class="tab-content">
                            <div class="tab-pane animation-fade active" id="projects"
                                 role="tabpanel" aria-expanded="true">
                                <div class="spots-list row">
                                    <div class="panel">
                                        <div class="panel-body container-fluid">
                                            <div class="row row-lg">
                                                <?= Html::beginForm('', 'post',
                                                    ['class' => 'location-filter']) ?>
                                                    <div class="form-group col-xs-12">
                                                        <div class="input-search">
                                                            <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                                            <?= Html::textInput('name', null,
                                                                ['class' => 'form-control', 'placeholder' => 'Search...',
                                                                    'autocomplete' => 'off']) ?>
                                                            <?= Html::button('',
                                                                [
                                                                    'class' => 'input-search-close icon wb-close',
                                                                    'aria-label' => 'Close'
                                                                ]) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-4 col-xs-12">
                                                        <!-- Example Basic -->
                                                        <div class="example-wrap m-lg-0">

                                                            <div>
                                                                <div class="pull-xs-right m-r-15">
                                                                    <?= Html::checkbox('type_id', false, [
                                                                        'data-plugin' => "switchery",
                                                                        'data-switchery' => 'true',
                                                                        'style' => 'display: none;',
                                                                        'value' => 1
                                                                    ]) ?>
                                                                </div>
                                                                <?= Html::label('New building', 'type_id',
                                                                    ['class' => 'p-t-3  m-l-25']) ?>
                                                            </div>

                                                            <div>
                                                                <div class="pull-xs-right m-r-15">
                                                                    <?= Html::checkbox('type_id', false, [
                                                                        'data-plugin' => "switchery",
                                                                        'data-switchery' => 'true',
                                                                        'style' => 'display: none;',
                                                                        'value' => 2
                                                                    ]) ?>
                                                                </div>
                                                                <?= Html::label('Renovation', 'type_id',
                                                                    ['class' => 'p-t-3 m-l-25']) ?>
                                                            </div>

                                                            <div>
                                                                <div class="pull-xs-right m-r-15">
                                                                    <?= Html::checkbox('type_id', false, [
                                                                        'data-plugin' => "switchery",
                                                                        'data-switchery' => 'true',
                                                                        'style' => 'display: none;',
                                                                        'value' => 3
                                                                    ]) ?>
                                                                </div>
                                                                <?= Html::label('Extension', 'type_id',
                                                                    ['class' => 'p-t-3 m-l-25']) ?>
                                                            </div>


                                                        </div>
                                                        <!-- End Example Basic -->
                                                    </div>
                                                    <div class="col-md-6 col-xl-4 col-xs-12">

                                                        <div class="form-group row">
                                                            <?= Html::label('Status', 'status_id',
                                                                ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                                                            <div class="col-md-9 col-xs-12">
                                                                <?= Html::dropDownList('status_id', null,
                                                                    Project::$statuses,
                                                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 col-xl-4 col-xs-12">

                                                        <div class="form-group row">
                                                            <?= Html::label('Budget', 'budget_id',
                                                                ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                                                            <div class="col-md-9 col-xs-12">
                                                                <?= Html::dropDownList('budget_id', null,
                                                                    Project::$budgets,
                                                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <?= Html::label('Category', 'category_id',
                                                                ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                                                            <div class="col-md-9 col-xs-12">
                                                                <?= Html::dropDownList('category_id', null,
                                                                    Project::$categories,
                                                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?= Html::endForm() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php /** @var Project $project */
                                            /* @var $project->location array */
                                    foreach ($projects as $key => $project): ?>
                                        <div class="col-xs-12 col-xxl-6 col-lg-12 projects-info location-item"
                                             data-location="<?= $project->location[Location::LAT] . ',' .
                                                $project->location[Location::LNG] ?>"
                                             data-filter_data='<?= Json::encode($project->getAttributes([
                                                     'type_id', 'status_id', 'budget_id', 'category_id', 'name'
                                             ])); ?>'
                                             data-spot-id="<?= 's_'.$key ?>">
                                            <div class="card card-shadow">
                                                <div class="card-header cover overlay">
                                                    <?= Html::a(Html::img($project->imageShow,
                                                        [
                                                            'class' => 'cover-image',
                                                            'alt' => 'spot_photo',
                                                        ]),
                                                        ['/company/view', 'id' => $project->id]) ?>
                                                    <div class="overlay-panel">
                                                        <div class="card-actions pull-xs-right">
                                                            <a href="javascript:void(0)">
                                                                <i class="icon wb-heart-outline text" aria-hidden="true"></i>
                                                                <i class="icon wb-heart text-active" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                                    <h3 class="card-title item-title">
                                                        <?= $project->name ?>
                                                    </h3>
                                                    <span class="item-name">exercitation</span>
                                                    <p class="card-text type-link">
                                                        <small>
                                                            Posted in
                                                            <a href="javascript:void(0)">
                                                                qui
                                                            </a>
                                                        </small>
                                                    </p>
                                                    <p class="card-text">
                                                        <?= $project->description ?>
                                                    </p>
                                                </div>
                                                <div class="card-block">
                                                    <div class="rating" data-score="4" data-nummber="5" data-plugin="rating">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-pane animation-fade" id="companies" role="tabpanel" aria-expanded="false">
                                <div class="panel">
                                    <div class="panel-body container-fluid">
                                        <?= Html::beginForm('', 'post',
                                            ['class' => 'location-filter']) ?>
                                            <div class="form-group">
                                                <div class="input-search">
                                                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                                    <?= Html::textInput('name', null,
                                                        ['class' => 'form-control', 'placeholder' => 'Search...',
                                                            'autocomplete' => 'off']) ?>
                                                    <?= Html::button('',
                                                        [
                                                            'class' => 'input-search-close icon wb-close',
                                                            'aria-label' => 'Close'
                                                        ]) ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-control-label col-xs-12 col-md-3">Type ??? :</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <select class="form-control" disabled>
                                                        <option>Design</option>
                                                        <option>Building</option>
                                                        <option>architecture</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-control-label col-xs-12 col-md-3">Add tags for search:</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <?= Select2::widget([
                                                        'name' => 'tags',
                                                        'value' => '',
                                                        'data' => $tags[Tag::COMPANY_TYPE],
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'class' => 'form-control',
                                                        'maintainOrder' => true,
                                                        'pluginOptions' => [
                                                            'tokenSeparators' => [',', ' '],
                                                            'maximumInputLength' => 10,
                                                            'allowClear' => true
                                                        ],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        <?= Html::endForm(); ?>
                                    </div>
                                </div>
                                <div class="hotels-list row">
                                    <?php /** @var \frontend\models\Company $company */
                                    foreach ($companies as $company):
                                        $filterData = $company->getAttributes(['name']);
                                        $filterData['tags[]'] = ArrayHelper::getValue($tags[Tag::COMPANY_TYPE], $company->id, []);
                                        ?>
                                        <div class="col-xs-12 col-xxl-6 col-xl-6 col-lg-6 col-md-12
                                            col-sm-12 companies-info location-item"
                                             data-location="<?= $company->location[Location::LAT] . ',' .
                                             $company->location[Location::LNG] ?>"
                                             data-filter_data='<?= Json::encode($filterData); ?>'
                                             data-hotel-id="h_1">
                                            <div class="card card-block card-inverse card-success">
                                                <div class="hotel-img">
                                                    <?= Html::img($company->imageShow) ?>
                                                </div>
                                                <h4 class="card-title item-name">
                                                    <?= Html::a(Html::img($company->imageShow),
                                                        ['/company/view', 'id' => $company->id],
                                                        ['class' => 'avatar bg-white img-bordered person-avatar']) ?>
                                                    <?= $company->name ?>
                                                </h4>
                                                <p class="card-text item-title"><?= $company->description ?></p>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-pane animation-fade page-content-table bg-white" id="persons" role="tabpanel"
                                 aria-expanded="false">
                                <div class="panel">
                                    <div class="panel-body container-fluid">
                                        <?= Html::beginForm('', 'post',
                                            ['class' => 'location-filter']) ?>
                                            <div class="form-group">
                                                <div class="input-search">
                                                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                                    <?= Html::textInput('name', null,
                                                        ['class' => 'form-control', 'placeholder' => 'Search...',
                                                            'autocomplete' => 'off']) ?>
                                                    <?= Html::button('',
                                                        [
                                                            'class' => 'input-search-close icon wb-close',
                                                            'aria-label' => 'Close'
                                                        ]) ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-control-label col-xs-12 col-md-3">Type ??? :</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <select class="form-control" disabled>
                                                        <option>Design</option>
                                                        <option>Building</option>
                                                        <option>architecture</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-control-label col-xs-12 col-md-3">Add tags for search:</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <?= Select2::widget([
                                                        'name' => 'tags',
                                                        'value' => '',
                                                        'data' => $tags[Tag::PERSON_TYPE],
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'class' => 'form-control',
                                                        'maintainOrder' => true,
                                                        'pluginOptions' => [
                                                            'tokenSeparators' => [',', ' '],
                                                            'maximumInputLength' => 10,
                                                            'allowClear' => true
                                                        ],
                                                    ]); ?>
                                                </div>
                                            </div>
                                        <?= Html::endForm() ?>
                                    </div>
                                </div>
                                <ul class="reviews-list">
                                    <li>
                                        <ul class="list-group list-group-dividered reviews-list">

                                            <?php /** @var \frontend\models\Person $person */
                                            foreach ($persons as $person):
                                                $filterData = [
                                                    'name' => $person->full_name,
                                                    'tags[]' => ArrayHelper::getValue($tags[Tag::PERSON_TYPE], $person->id, [])
                                                ];
                                                ?>
                                                <li class="list-group-item persons-info" data-review-id="r_1"
                                                    data-location="<?= $person->location[Location::LAT] . ',' .
                                                    $project->location[Location::LNG] ?>"
                                                    data-filter_data='<?= Json::encode($filterData); ?>'>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <?= Html::a(Html::img($person->imageShow, [
                                                                'class' => 'img-responsive'
                                                            ]), ['/person/profile', 'id' => $person->id],
                                                                ['class' => 'avatar']); ?>
                                                        </div>
                                                        <div class="media-body content">
                                                            <h4 class="media-heading item-name"><?= $person->full_name; ?></h4>
                                                            <div class="rating" data-plugin="rating" data-score="4" data-number="5" data-read-only="true">
                                                            </div>
                                                        </div>
                                                        <div class="media-right">
                                                            <span class="item-title"><?= $person->position; ?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Travel Options Siderbar -->
    <div class="page-main">
        <div id="map"></div>
    </div>
</div>


