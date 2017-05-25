<?php
/* @var $this yii\web\View */
use frontend\models\Company;
use yii\helpers\Html;

/* @var $company Company */
/* @var $cooperation array \frontend\models\Person */
/* @var $admins array \frontend\models\Person */

// TODO добавить сюда новые скрипты
?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-300 m-b-30"
                 style="background-image: url(<?= \yii\helpers\Url::to('@web/img/layer_images/company-background.png') ?>);
                         background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-30 blue-grey-800"><?= $company->name ?></div>
                    <ul class="list-inline font-size-14">
                        <li class="list-inline-item">
                            <i class="icon wb-map m-r-5" aria-hidden="true"></i> <b>Saltsburg, Austria</b>
                        </li>
                        <li class="list-inline-item m-l-20">
                            <i class="icon wb-heart m-r-5" aria-hidden="true"></i> <b>100, 256</b>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Team Total Completed -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">

                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body p-0">


                        <div class="page-nav-tabs">
                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#team" aria-controls="team" aria-expanded="true" role="tab">Team</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#cooperation" aria-controls="cooperation" aria-expanded="false" role="tab">Cooperation</a>
                                </li>
                            </ul>
                        </div>


                        <div class="page-content tab-content page-content-table nav-tabs-animate">
                            <div class="tab-pane animation-fade active" id="team" role="tabpanel" aria-expanded="true">
                                <?= $this->render('_persons', [
                                    'persons' => $admins,
                                    'additionData' => ['id' => $company->id],
                                ]) ?>
                            </div>

                            <div class="tab-pane animation-fade" id="cooperation" role="tabpanel" aria-expanded="false">
                                <?= $this->render('_persons', [
                                    'persons' => $cooperation,
                                    'additionData' => ['id' => $company->id],
                                ]) ?>
                            </div>
                    </div>

                </div>
                <!-- End Panel -->
            </div>
        </div>

        <!-- End First Row -->
        <!-- Second Row -->
        <!-- Personal -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">

            <div id="personalCompletedWidget" class="card card-shadow p-b-20">

                <div class="card-header card-header-transparent cover overlay">
                    <?= Html::img('@web/img/portraits/placeholder.png', [
                        'class' => 'cover-image',
                    ]) ?>
                    <div class="overlay-panel overlay-background vertical-align" style="background-color:  #47B8C6;">
                        <div class="vertical-align-middle">
                            <?= Html::a(
                                    Html::img($company->image, [
                                    'class' => 'cover-image',
                            ]), ['/'], ['class' => 'avatar']) ?>
                            <div class="font-size-20 m-t-10"><?= $company->name ?></div>
                            <div class="font-size-14">Construction company</div>
                        </div>
                    </div>
                </div>

                <div class="card-block">

                    <?php if ($company->isPerson(Company::COMMUNITY_ADMIN_TYPE, $admins['data'])): ?>
                        <div class="row text-xs-center">
                            <div class="col-xs-12 ">
                                <?= Html::a('edit', ['/'], ['class' => 'btn btn-block btn-primary btn-outline']) ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row text-xs-center m-b-20">

                            <div class="col-xs-6">
                                <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Message', ['/'],
                                    ['class' => 'btn btn-block btn-primary']);
                                ?>
                            </div>
                            <div class="col-xs-6">
                                <?php if ($company->isPerson(Company::COMMUNITY_PARTICIPANT_TYPE, $cooperation['data'])): ?>
                                    <?= Html::a('<i class="icon fa-times" aria-hidden="true"></i>Leave',
                                        ['leave', 'id' => $company->id],
                                        ['class' => 'btn btn-block btn-primary']); ?>
                                <?php else: ?>
                                    <?= Html::a('<i class="icon wb-user-add" aria-hidden="true"></i>Join',
                                        ['join', 'id' => $company->id],
                                        ['class' => 'btn btn-block btn-primary']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="table-reponsive">

                        <div  class="card card-shadow p-b-20">

                            <div class="card-block">

                                <div class="table-responsive">
                                    <table class="table">

                                        <tbody>
                                        <tr>

                                            <td>
                                                Location
                                            </td>

                                            <td>
                                                Austria
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                Countries
                                            </td>
                                            <td>
                                                Austria, Germany, Poland
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Types of jobs
                                            </td>
                                            <td>
                                                Design from start to finish of complex projects
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Email
                                            </td>

                                            <td>
                                                <?= $company->email ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Phone
                                            </td>
                                            <td>
                                                <?= $company->phone ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <!-- To Do List -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 col-xxl-8">

            <!-- Panel -->
            <div class="panel">
                <div class="panel-body">
                    <form class="page-search-form" role="search">
                        <div class="input-search input-search-dark">
                            <i class="input-search-icon wb-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search">
                            <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                        </div>
                    </form>
                    <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">

                        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab" aria-expanded="false">Projects</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab" aria-expanded="true">Marketplace</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane animation-fade" id="all_contacts" role="tabpanel" aria-expanded="false">
                                <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://s-media-cache-ak0.pinimg.com/originals/05/12/21/05122101571dd2b6a0134aba4bdb3713.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://s-media-cache-ak0.pinimg.com/originals/05/12/21/05122101571dd2b6a0134aba4bdb3713.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title ">Project №1 </h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://mydecorative.com/wp-content/uploads/2014/06/Catedral-Modern-Architecture.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://mydecorative.com/wp-content/uploads/2014/06/Catedral-Modern-Architecture.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №2</h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://www.linkcrafter.com/wp-content/uploads/2016/06/inspiration-ideas-modern-architecture-house-plans-and-design-cool-modern-house-designs-minecraft-best-modern-home-designs-1024x768.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://www.linkcrafter.com/wp-content/uploads/2016/06/inspiration-ideas-modern-architecture-house-plans-and-design-cool-modern-house-designs-minecraft-best-modern-home-designs-1024x768.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №3</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcR-zGmtX8gxBPIEgxXk0ULt-R8wx-2fh6HdSgFdT6GUbWgOzgCd" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcR-zGmtX8gxBPIEgxXk0ULt-R8wx-2fh6HdSgFdT6GUbWgOzgCd"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №4</h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQeqoQl5BnUYAJx4bOeMk3f_xinXu_nWMGvFYP2bhUCVSDliwG5" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQeqoQl5BnUYAJx4bOeMk3f_xinXu_nWMGvFYP2bhUCVSDliwG5"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №5</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://hdwallpaperset.com/wp-content/uploads/Modern-Architecture-Desktop-Background-Wallpaper-1024x768.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://hdwallpaperset.com/wp-content/uploads/Modern-Architecture-Desktop-Background-Wallpaper-1024x768.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №6</h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://www.linkcrafter.com/wp-content/uploads/2016/05/inspiring-contemporary-rustic-design-the-s-house-by-ko-ko-architect-home-design-architect-home-design-in-india-1024x768.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://www.linkcrafter.com/wp-content/uploads/2016/05/inspiring-contemporary-rustic-design-the-s-house-by-ko-ko-architect-home-design-architect-home-design-in-india-1024x768.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №7</h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://www.windowsandsiding.net/wp-content/uploads/2015/08/zaha-hadid-female-architect-1024x768.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://www.windowsandsiding.net/wp-content/uploads/2015/08/zaha-hadid-female-architect-1024x768.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №8</h4>
                                                <p class="card-text"> <i class="icon wb-check" aria-hidden="true"></i>completed  </p>
                                            </div>
                                        </div>
                                    </li>


                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://i.ytimg.com/vi/QKKSYlD9Oi0/maxresdefault.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://i.ytimg.com/vi/QKKSYlD9Oi0/maxresdefault.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №9</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>



                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTb9hAoyl3XOh5uu9pOcpPNxis8lWCLD_bgwUfKxiQSVnSi13bo_g" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTb9hAoyl3XOh5uu9pOcpPNxis8lWCLD_bgwUfKxiQSVnSi13bo_g"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №10</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>


                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="http://www.pphomes.net/wp-content/uploads/2015/02/modern-house-architecture-and-design.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="http://www.pphomes.net/wp-content/uploads/2015/02/modern-house-architecture-and-design.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №11</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>


                                    <li class="list-group-item">
                                        <div class="card card-shadow">
                                            <figure class="card-img-top overlay-hover overlay">
                                                <img class="overlay-figure overlay-scale" src="https://s-media-cache-ak0.pinimg.com/originals/3f/f1/4c/3ff14cfd6969ab40d8956eb3c3b07e34.jpg" alt="...">
                                                <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                    <a class="icon wb-search" href="https://s-media-cache-ak0.pinimg.com/originals/3f/f1/4c/3ff14cfd6969ab40d8956eb3c3b07e34.jpg"></a>
                                                </figcaption>
                                            </figure>
                                            <div class="card-block">
                                                <h4 class="card-title">Project №12</h4>
                                                <p class="card-text"> <i class="icon wb-time" aria-hidden="true"></i>work in progress  </p>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                <nav>
                                    <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                </nav>
                            </div>
                            <div class="tab-pane animation-fade active" id="my_contacts" role="tabpanel" aria-expanded="true">


                                <div class="row row-lg">



                                    <div class="row row-lg">
                                        <div class="col-xl-12 col-xs-12">
                                            <!-- Example Tabs Left -->
                                            <div class="example-wrap">
                                                <div class="nav-tabs-vertical" data-plugin="tabs">
                                                    <ul class="nav nav-tabs m-r-55" role="tablist">


                                                        <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleTabsLeftFour" aria-controls="exampleTabsLeftFour" role="tab" aria-expanded="true">Request</a></li>
                                                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleTabsLeftOne" aria-controls="exampleTabsLeftOne" role="tab" aria-expanded="false">Offers</a></li>
                                                    </ul>
                                                    <div class="tab-content p-y-15">
                                                        <div class="tab-pane active" id="exampleTabsLeftFour" role="tabpanel" aria-expanded="true">
                                                            <ul class="list-group blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="https://s-media-cache-ak0.pinimg.com/originals/ba/43/5e/ba435e514b1b6428a13e2b3372a82646.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="https://s-media-cache-ak0.pinimg.com/originals/ba/43/5e/ba435e514b1b6428a13e2b3372a82646.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №1</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="http://depoole.com/wp-content/uploads/2016/08/modern-house-minecraft.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="http://depoole.com/wp-content/uploads/2016/08/modern-house-minecraft.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №2</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="http://modern-homedesign.com/wp-content/uploads/2016/11/Modern-House-Design-With-Rooftop-2017-Of-Modern-House-Deck-Ign-2017-Of-Modern-Home-Ign-Single-Floor-2017-Of-Modern-One-Story-Ranch-House-One-Story-House-Exterior-Ign-Ideas-Lrg-Dd71cdf6c15747f0-1024x768.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="http://modern-homedesign.com/wp-content/uploads/2016/11/Modern-House-Design-With-Rooftop-2017-Of-Modern-House-Deck-Ign-2017-Of-Modern-Home-Ign-Single-Floor-2017-Of-Modern-One-Story-Ranch-House-One-Story-House-Exterior-Ign-Ideas-Lrg-Dd71cdf6c15747f0-1024x768.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №3</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="http://inspiringhomeideas.net/wp-content/uploads/2016/01/Fascinating-modern-brick-building-architecture-plus-modern-buildings-using-roman-architecture-1024x768.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="http://inspiringhomeideas.net/wp-content/uploads/2016/01/Fascinating-modern-brick-building-architecture-plus-modern-buildings-using-roman-architecture-1024x768.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №4</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTVaQCBKSxbIwV9wOPpBbIOCoqbR4vIa2IcUHd7ZYB73dmNO4Ky" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTVaQCBKSxbIwV9wOPpBbIOCoqbR4vIa2IcUHd7ZYB73dmNO4Ky"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №5</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="http://media.gettyimages.com/photos/directly-below-shot-of-ceiling-of-modern-building-picture-id564763181" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="http://media.gettyimages.com/photos/directly-below-shot-of-ceiling-of-modern-building-picture-id564763181"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №6</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTuYoD-AeuNf5nwKnec__4FHA2oZZvVQaVZcmoxtQA004Eac0KR" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTuYoD-AeuNf5nwKnec__4FHA2oZZvVQaVZcmoxtQA004Eac0KR"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №7</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="http://modern-homedesign.com/wp-content/uploads/2016/11/Modern-Building-Exterior-Design-Of-B8f02d9300833f0d0e3684614fda35ab-1024x768.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="http://modern-homedesign.com/wp-content/uploads/2016/11/Modern-Building-Exterior-Design-Of-B8f02d9300833f0d0e3684614fda35ab-1024x768.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №8</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>


                                                                <li class="list-group-item">
                                                                    <div class="card card-shadow">
                                                                        <figure class="card-img-top overlay-hover overlay">
                                                                            <img class="overlay-figure overlay-scale" src="https://odis.homeaway.com/odis/listing/a1e985d7-88cf-4b4e-9a4f-3b924bb5ba60.c10.jpg" alt="...">
                                                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                                                <a class="icon wb-search" href="https://odis.homeaway.com/odis/listing/a1e985d7-88cf-4b4e-9a4f-3b924bb5ba60.c10.jpg"></a>
                                                                            </figcaption>
                                                                        </figure>
                                                                        <div class="card-block">
                                                                            <h4 class="card-title">Project №9</h4>
                                                                        </div>
                                                                    </div>
                                                                </li>




                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" id="exampleTabsLeftOne" role="tabpanel" aria-expanded="false">
                                                            Puto loqueretur maxime tuentur statuam quanta quamquam multoque cogitavisse, romano
                                                            continens repellat omnis liquidae, inveneris aegritudine
                                                            inesse dirigentur graece secundum ipso unam, cognitionis
                                                            isdem mortem tantis opibus turma virtus legum, procedat accusantium
                                                            ipse sine fuissent desideraturam. Naturalem virtutum familiari
                                                            nasci tenebo provident convincere. Senserit ultima faciam
                                                            deterius plurimum ornateque curiosi. Oratione sit, dices
                                                            malunt quibusdam. Distinguique parendum contentam graecam
                                                            sale.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Example Tabs Left -->
                                        </div>

                                    </div>



                                </div>




                                <nav>
                                    <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel -->
        </div>
    </div>
    <!-- End To Do List -->

    <!-- Recent Activity -->

    <!-- End Recent Activity -->
    <!-- End Second Row -->
</div>

