<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;

//$this->registerCssFile('@web/css/media.min.css');

$this->params['body-class'] = 'app-media page-aside-left';
?>


<div class="page-header h-300 m-b-30"
     style="
     background-image: url(<?= \yii\helpers\Url::to('@web/img/layer_images/marketplace-background.png') ?>);
     background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
        <div class="font-size-70 m-b-30 blue-grey-800">Marketplace</div>

    </div>
</div>

<div class="page bg-white">
    <!-- Media Sidebar -->
    <div class="page-aside">
        <div class="page-aside-switch">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
            <i class="icon wb-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="page-aside-inner page-aside-scroll">
            <div data-role="container">
                <div data-role="content">
                    <section class="page-aside-section">
                        <h5 class="page-aside-title">Main</h5>
                        <div class="list-group">
                            <a class="list-group-item active" href="javascript:void(0)"><i class="icon wb-dashboard" aria-hidden="true"></i>Overview</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-pluse" aria-hidden="true"></i>Activity</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-heart" aria-hidden="true"></i>Dearest</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-folder" aria-hidden="true"></i>Folders</a>
                        </div>
                    </section>
                    <section class="page-aside-section">
                        <h5 class="page-aside-title">Filter</h5>
                        <div class="list-group">
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-image" aria-hidden="true"></i>Images</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-volume-high" aria-hidden="true"></i>Audio</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-camera" aria-hidden="true"></i>Video</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-file" aria-hidden="true"></i>Notes</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-link-intact" aria-hidden="true"></i>Links</a>
                            <a class="list-group-item" href="javascript:void(0)"><i class="icon wb-order" aria-hidden="true"></i>Files</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Media Content -->
    <div class="page-main">
        <!-- Media Content Header -->
        <div class="page-header">
            <h1 class="page-title">Overview</h1>
            <div class="page-header-actions">
                <form>
                    <div class="input-search input-search-dark">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="" placeholder="Search...">
                    </div>
                </form>
            </div>
        </div>
        <!-- Media Content -->
        <div id="mediaContent" class="page-content page-content-table" data-plugin="selectable">
            <!-- Actions -->
            <div class="page-content-actions">
                <div class="pull-xs-right">
                    <div class="btn-group media-arrangement" role="group">
                        <button class="btn btn-outline btn-default active" id="arrangement-grid" type="button"><i class="icon wb-grid-4" aria-hidden="true"></i></button>
                        <button class="btn btn-outline btn-default" id="arrangement-list" type="button"><i class="icon wb-list" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>
            <!-- Media -->
            <div class="media-list is-grid p-b-50" data-plugin="animateList" data-animate="fade"
                 data-child="li">
                <ul class="blocks blocks-100 blocks-xxl-4 blocks-xl-3 blocks-lg-3 blocks-md-2 blocks-sm-2"
                    data-plugin="animateList" data-child=">li">
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Lorem ipsum</div>
                                <div class="time">1 minutes ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Voluptate pariatur</div>
                                <div class="time">20 minutes ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Laboris Excepteur</div>
                                <div class="time">1 hour ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Consequat ullamco</div>
                                <div class="time">3 hours ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Eiusmod amet</div>
                                <div class="time">7 hours ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">ullamco quis</div>
                                <div class="time">16 hours ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Reprehenderit</div>
                                <div class="time">1 day ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Ullamco fugiat</div>
                                <div class="time">2 days ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Dolor veniam</div>
                                <div class="time">3 days ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Minim officia</div>
                                <div class="time">7 days ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">cupidatat fugiat</div>
                                <div class="time">1 week ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="media-item" data-toggle="slidePanel" data-url="panel.tpl">

                            <div class="image-wrap">
                                <?= Html::img('@web/img/portraits/placeholder.png',
                                    ['class' => 'image img-rounded']) ?>
                            </div>
                            <div class="info-wrap">
                                <div class="dropdown">
                    <span class="icon wb-settings" data-toggle="dropdown" aria-expanded="false" role="button"
                          data-animation="scale-up"></span>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-pencil" aria-hidden="true"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-download" aria-hidden="true"></i>Download</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="icon wb-trash" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <div class="title">Fugiat nisi</div>
                                <div class="time">2 weeks ago</div>
                                <div class="media-item-actions btn-group">
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Edit" data-toggle="tooltip"
                                            data-container="body" data-placement="top" data-trigger="hover"
                                            type="button">
                                        <i class="icon wb-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Download"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-download" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-icon btn-pure btn-default" data-original-title="Delete"
                                            data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-trigger="hover" type="button">
                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>