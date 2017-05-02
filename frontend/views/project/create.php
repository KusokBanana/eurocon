<?php

/* @var $this \yii\web\View*/
/* @var $newProject \frontend\models\Project */

use yii\widgets\ActiveForm;

$this->registerCssFile('@web/css/jquery-wizard.min.css');
$this->registerCssFile('@web/css/formValidation.min.css');

$this->registerJsFile('@web/js/assets/jquery-wizard.min.js', ['position' => \yii\web\View::POS_LOAD]);
$this->registerJsFile('@web/js/assets/matchheight.min.js', ['position' => \yii\web\View::POS_LOAD]);
$this->registerJsFile('@web/js/assets/wizard.min.js', ['position' => \yii\web\View::POS_LOAD]);

?>

<div class="page-header h-100 m-b-30" style="background-image: url();  background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-0 m-xs-0">
        <div class="font-size-40 m-b-30 blue-grey-800">Single Project Builder</div>

    </div>
</div>

<div class="page">

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <!-- Panel Wizard Form -->
                <div class="panel" id="exampleWizardForm">
                    <div class="panel-heading">
                        <h3 class="panel-title">Start to create</h3>
                    </div>

                    <div class="panel-body">
                        <!-- Steps -->
                        <div class="pearls row">
                            <div class="pearl current col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-user" aria-hidden="true"></i></div>
                                <span class="pearl-title">Fill the gaps</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-order" aria-hidden="true"></i></div>
                                <span class="pearl-title">Project description</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                                <span class="pearl-title">Confirmation</span>
                            </div>
                        </div>
                        <!-- End Steps -->
                        <!-- Wizard Content -->
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="wizard-content">
                            <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                                <form id="exampleAccountForm">
                                    <div class="form-group">
                                        <label class="form-control-label" for="inputUserName">Project's owner:</label>
                                        <input type="text" class="form-control" id="inputUserName" name="username" required="required">
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($newProject, 'name')
                                            ->textInput(['class' => 'form-control'])
                                            ->label(null, ['class' => 'form-control-label']) ?>
<!--                                        <label class="form-control-label" for="inputPassword">Project's name:</label>-->
<!--                                        <input type="password" class="form-control" id="inputPassword" name="password"-->
<!--                                               required="required">-->


                                        <div class="form-group">
                                            <label class="form-control-label" for="inputCVVOne">Tags:</label>
                                            <input type="text" class="form-control" id="inputCVVOne" name="cvv" placeholder="Tags">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="inputCVVOne">Date:</label>
                                            <input type="text" class="form-control" id="inputCVVOne" name="cvv" placeholder="Date">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="inputCVVOne">Participants</label>
                                            <input type="text" class="form-control" id="inputCVVOne" name="cvv" placeholder="Participants">
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="wizard-pane" id="exampleBilling" role="tabpanel">

                                <div class="container">
                                    <div class="card card-shadow wall-posting">
                                        <div class="card-block p-0">
                                            <div class="form-group m-b-0">

                                                <div class="p-10">
                                                    <button class="btn btn-pure btn-default icon wb-image" type="button" name="button" data-toggle="modal" data-target="#myModalimage"></button>
                                                    <button class="btn btn-pure btn-default icon wb-video" type="button" name="button" data-toggle="modal" data-target="#myModalvideo"></button>
                                                    <button class="btn btn-pure btn-default icon wb-map" type="button" name="button" data-toggle="modal" data-target="#myModalplaces"></button>
                                                </div>
<!--                                                <input class="form-control form-control-lg" type="text" name="write" placeholder="add text, photo, video, places">-->
                                                <?= $form->field($newProject, 'name')
                                                    ->textarea(
                                                    [
                                                        'class' => 'form-control form-control-lg',
                                                        'placeholder' => 'add text, photo, video, places',
                                                    ])
                                                    ->label(false) ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Trigger the modal with a button -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="myModalimage" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">add your image</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="example">
                                                        <input type="file" id="input-file-events" class="dropify-event" data-default-file="../../../global/photos/placeholder.png">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="modal fade" id="myModalvideo" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">add your video</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="example">
                                                        <input type="file" id="input-file-events" class="dropify-event" data-default-file="../../../global/photos/placeholder.png">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal fade" id="myModalplaces" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">add your places</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select class=" data-selected-text-format multiple select" data-country="US"></select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="wizard-pane" id="exampleGetting" role="tabpanel">
                                <div class="text-xs-center m-y-20">
                                    <i class="icon wb-check font-size-40" aria-hidden="true"></i>
                                    <h4>You're succeed to create your new project. Congratulations! </h4>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <!-- End Wizard Content -->
                    </div>
                </div>
                <!-- End Panel Wizard One Form -->
            </div>


            <select class=" data-selected-text-format multiple select" data-country="US"><option> </<option value=""></option></select>
        </div>
    </div>
</div>
