<?php

/* @var $this \yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['is_main'] = true;
?>


<div class="page bg-white">
    <div class="page-content container-fluid">
        <header class="business-header" style="
    height: 400px;
    background: url(<?= Url::to('@web/img/layer_images/main_page-background.jpg') ?>) center center no-repeat scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12	col-sm-6 col-md-6 col-lg-6">

                    </div>
                    <div class="col-xs-12	col-sm-6 col-md-6 col-lg-6 p-t-20 m-t-70">
                        <h2>Join to the community</h2>
                        <p>Create your team, start your new project, engage participants! Everyone will see your job and you will see jobs of everyone. Join to Eurocon.</p>
                        <?= Html::a('<span><i class="icon wb-hammer" aria-hidden="true"></i>Create a project</span>',
                            ['/project/create'], ['class' => 'btn btn-dark btn-animate btn-animate-side m-t-20']); ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container">
            <!-- /.row -->
            <div class="row text-xs-center">
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-12 text-xs-center m-t-30 m-b-60">
                    <h3>Create modern technology project with the best professionals</h3>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center " width="300" height="250"src="http://www.architecturebeast.com/wp-content/uploads/2014/08/Top_50_Modern_House_Designs_Ever_Built_featured_on_architecture_beast_02.jpg" alt="">
                    <h2 class="text-xs-center">Project #1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center " width="300" height="250" src="https://s-media-cache-ak0.pinimg.com/736x/04/8b/fe/048bfebc685cf9fdcf5d2fea072db612.jpg" alt="">
                    <h2 class="text-xs-center">Project #2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center " width="300" height="250" src="http://www.architecturebeast.com/wp-content/uploads/2014/08/Top_50_Modern_House_Designs_Ever_Built_featured_on_architecture_beast_09.jpg" alt="">
                    <h2 class="text-xs-center">Project #3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <!-- /.row -->
            <div class="row text-xs-center">
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-12 text-xs-center m-t-30 m-b-60">
                    <h3>Join to the community of professionals</h3>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-circle img-responsive img-center " width="300" height="300" src="https://static.tildacdn.com/tild3161-3334-4337-b330-613366356431/korneev.jpg&quot" alt="">
                    <h2 class="text-xs-center">Professional #1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-circle img-responsive img-center " width="300" height="300" src="https://static.tildacdn.com/tild3538-3636-4631-a138-633436386562/m_doreuly.jpg&quot;" alt="">
                    <h2 class="text-xs-center">Professional #2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-circle img-responsive img-center " width="300" height="300" src="https://static.tildacdn.com/tild3761-6533-4262-b335-346164613630/kagarov.jpg&quot;" alt="">
                    <h2 class="text-xs-center">Professional #3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <!-- /.row -->
            <div class="row text-xs-center">
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-12 text-xs-center m-t-30 m-b-60">
                    <h3>Get access to the best brands</h3>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center " width="250" height="250" src="https://image.shutterstock.com/z/stock-vector-universal-business-or-building-icon-logo-185329052.jpg" alt="">
                    <h2 class="text-xs-center">Professional #1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center "  width="250" height="250" src="https://image.shutterstock.com/z/stock-vector-vector-abstract-colorful-city-building-composition-sign-icon-logo-isolated-227788621.jpg" alt="">
                    <h2 class="text-xs-center">Professional #2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-xs-12	col-sm-12	col-md-12 col-lg-4">
                    <img class="img-rounded img-responsive img-center "  width="250" height="250" src="https://image.shutterstock.com/z/stock-vector-real-estate-building-ceo-business-company-in-glass-vector-logo-icon-215919520.jpg" alt="">
                    <h2 class="text-xs-center">Professional #3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
