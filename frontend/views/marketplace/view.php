<?php

use frontend\assets\AppAsset;
use frontend\models\MarketplaceItem;
use frontend\models\Post;
use frontend\widgets\CustomModal;
use frontend\widgets\Forum;
use yii\helpers\Html;

/* @var $item MarketplaceItem */
/* @var $newPost Post */
/* @var $posts array*/

$this->registerJsFile('@web/js/forum.js',  ['depends' => [AppAsset::className()]]);
$this->registerJsFile('@web/js/Plugin/input-group-file.min.js',  ['depends' => [AppAsset::className()]]);

?>


<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-150 m-b-30"  style="border: double 10px; border-color: #57c7d4; background-color: #E8F1F8;">
                <div class="text-xs-center blue-grey-800 m-t-0 m-xs-0">
                    <div class="font-size-50 m-b-30 blue-grey-800"><?= $item->name ?></div>
                </div>
            </div>
            <!-- End Team Total Completed -->
            <!-- End First Row -->

            <div class="col-xs-12 col-xxl-8  col-xl-8 col-lg-8">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">

                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#product_description"
                                       aria-controls="test" role="tab">Product Description</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#project_related"
                                       aria-controls="project_related" role="tab"
                                       aria-expanded="false">Related Project</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#forum" aria-controls="forum"
                                       role="tab" aria-expanded="false">Forum</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane animation-fade active" id="product_description"
                                     role="tabpanel" aria-expanded="false">
                                    <div class="card card-shadow m-t-20">
                                        <div class="row">
                                            <div class="col-xs-3 col-lg-3 col-sm-3">
                                                <div class="card-img-top cover overlay overlay-hover">
                                                    <?= Html::img($item->imageShow,
                                                        ['class' => 'cover-image overlay-figure overlay-scale']) ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-9 col-lg-9 col-sm-9">
                                                <div class="card-block">
                                                    <h3 class="card-title"><?= $item->name ?></h3>
                                                    <p class="card-text">
                                                        <small><?= date('M d, Y', strtotime($item->date)) ?></small>
                                                    </p>
                                                    <p class="card-text"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane animation-fade" id="project_related" role="tabpanel" aria-expanded="false">
                                    <ul class="list-group m-t-20">
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#"><div class="avatar avatar-online">
                                                            <img src="../add-images/company-avatar.png" alt="...">
                                                        </div></a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Company 1
                                                    </h4>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel nisl sodales, ullamcorper nunc id, congue tellus.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#"><div class="avatar avatar-online">
                                                            <img src="../add-images/company-avatar.png" alt="...">
                                                        </div></a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Company 2
                                                    </h4>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel nisl sodales, ullamcorper nunc id, congue tellus.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#"><div class="avatar avatar-online">
                                                            <img src="../add-images/company-avatar.png" alt="...">
                                                        </div></a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Company 3
                                                    </h4>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel nisl sodales, ullamcorper nunc id, congue tellus.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#"><div class="avatar avatar-online">
                                                            <img src="../add-images/company-avatar.png" alt="...">
                                                        </div></a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        Company 4
                                                    </h4>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel nisl sodales, ullamcorper nunc id, congue tellus.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane animation-fade" id="forum" role="tabpanel" aria-expanded="false">

                                    <?= Forum::widget([
                                        'data' => $posts,
                                        'additionData' => [
                                            'id' => $item->id
                                        ]
                                    ]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div><!-- Second Row -->
            <!-- Personal -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4  col-xl-4" >

                <div class="col-xs-12 col-xxl-12 col-xl-12 col-lg-12 ">
                    <div class="panel">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>Product owner:
                                    </td>
                                    <td>
                                        Josef Schwaiger
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product name:</td>
                                    <td><?= $item->name ?></td>
                                </tr>
                                <tr>
                                    <td>Tags:
                                    </td>
                                    <td>
                                        <span class="tag tag-round tag-primary">Wood</span>
                                        <span class="tag tag-round tag-primary">House</span>
                                        <span class="tag tag-round tag-primary">Parquet</span>
                                        <span class="tag tag-round tag-primary">high quality</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product site:</td>
                                    <td>example@mail.com</td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td><?= date('d.m.Y', strtotime($item->date)) ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" class="btn btn-icon social-facebook"><i class="icon bd-facebook" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-twitter"><i class="icon bd-twitter" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-linkedin"><i class="icon bd-linkedin" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-instagram"><i class="icon bd-instagram" aria-hidden="true"></i></button>
                                    </td>
                                </tr>


                            </table>
                            <div class="row text-xs-center">
                                <div class="col-xs-12 ">
                                    <button type="button" class="btn btn-block btn-primary btn-outline btn-primary"
                                            data-target="#exampleTabs" data-toggle="modal">edit</button>

                                    <div class="modal fade" id="exampleTabs" aria-hidden="true"
                                         aria-labelledby="exampleModalTabs" role="dialog" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <h4 class="modal-title" id="exampleModalTabs">Setting</h4>
                                                </div>
                                                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                                    <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1" aria-controls="exampleLine1" role="tab">Product Profile</a></li>
                                                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2" aria-controls="exampleLine2" role="tab">Product Information</a></li>
                                                </ul>
                                                <div class="modal-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                                                            <div class="col-md-12 col-lg-12 col-xs-12">
                                                                <!-- Example Horizontal Form -->
                                                                <div class="example-wrap">
                                                                    <div class="example">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Product Name: </label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="name" placeholder="Great project" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="form-control-label col-xs-12 col-md-3">Product Owner:</label>
                                                                                <div class="col-md-9 col-xs-12">
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control" name="" placeholder="Search Participants..">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Product site:</label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="company_site" placeholder="example-site.com" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label"> Description: </label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <textarea class="form-control" placeholder="Briefly Describe Your Project"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Photo: </label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <div class="input-group input-group-file" data-plugin="inputGroupFile">
                                                                                        <input type="text" class="form-control" readonly="">
                                                                                        <span class="input-group-btn">
                               <span class="btn btn-outline btn-file">
                                 <i class="icon wb-upload" aria-hidden="true"></i>
                                 <input type="file" name="" multiple="">
                                                                                    </div>
                                                                                    </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Facebook:</label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="company_site" placeholder="example-site.com" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Twitter:</label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="company_site" placeholder="example-site.com" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">LinkedIn:</label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="company_site" placeholder="example-site.com" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label">Instargarm:</label>
                                                                                <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                                                                    <input type="text" class="form-control" name="company_site" placeholder="example-site.com" autocomplete="off">
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- End Example Horizontal Form -->
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="exampleLine2" role="tabpanel">
                                                            <div class="col-md-12 col-lg-12 col-xs-12">
                                                                <!-- Example Horizontal Form -->
                                                                <div class="example-wrap">
                                                                    <div class="example">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <label class="form-control-label col-xs-12 col-md-3">Project Type:</label>
                                                                                <div class="col-md-9 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <option>New building</option>
                                                                                        <option>Renovation</option>
                                                                                        <option>Extension</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="form-control-label col-xs-12 col-md-3">Product Status:</label>
                                                                                <div class="col-md-9 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <option>Planning</option>
                                                                                        <option>Confirmed</option>
                                                                                        <option>Under Constructin</option>
                                                                                        <option>Ready</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="form-control-label col-xs-12 col-md-3">Budget:</label>
                                                                                <div class="col-md-9 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <option>[ 0; 1 mln $ ]</option>
                                                                                        <option>[ 1 mln $; 3 mln $ ]</option>
                                                                                        <option>[ 3 mln $; 5 mln $ ]</option>
                                                                                        <option>[ 5 mln $; 10 mln $ ]</option>
                                                                                        <option> >10 mln $ </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="form-control-label col-xs-12 col-md-3">Product Category:</label>
                                                                                <div class="col-md-9 col-xs-12">
                                                                                    <select class="form-control">
                                                                                        <option>Private / Farms</option>
                                                                                        <option>Residential</option>
                                                                                        <option>  Hotel</option>
                                                                                        <option>Restaurant</option>
                                                                                        <option>Shop</option>
                                                                                        <option>Office</option>
                                                                                        <option>Logistic</option>
                                                                                        <option>Industry</option>
                                                                                        <option>Health and Medicine</option>
                                                                                        <option> Retirement residentials</option>
                                                                                        <option>Schools and Universities</option>
                                                                                        <option>Culture</option>
                                                                                        <option>Sport</option>
                                                                                        <option>Sacral</option>
                                                                                        <option>Goverment</option>
                                                                                        <option>rports and Railway stations</option>
                                                                                        <option>Energetics</option>
                                                                                        <option>Infrastructure</option>
                                                                                        <option>Landscape</option>
                                                                                        <option>Other</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!-- End Example Horizontal Form -->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Personal -->
        <!-- To Do List -->

    </div>
    <!-- End To Do List -->

    <!-- Recent Activity -->

    <!-- End Recent Activity -->
    <!-- End Second Row -->
</div>

<?= CustomModal::widget([
    'type' => 'forum_add_post',
    'model' => $newPost,
    'additionalData' => [
        'for_model' => $item
    ]
]) ?>