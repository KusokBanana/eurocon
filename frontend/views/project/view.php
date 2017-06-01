<?php
/* @var $this yii\web\View */
/* @var $project Project */
/* @var $participants \frontend\models\Person */
/* @var $potentialSubscribers array */
/* @var $projectTimeline \frontend\models\ProjectTimeline */

use frontend\assets\AppAsset;
use frontend\models\Project;
use frontend\widgets\CustomModal;
use yii\helpers\Html;

$this->registerJsFile('@web/js/project.js',  ['depends' => [AppAsset::className()]]);
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
                    <div class="font-size-50 m-b-30 blue-grey-800">
                        <?= $project->name ?>
                    </div>

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
                                    <a class="nav-link active" data-toggle="tab" href="#project_timeline"
                                       aria-controls="project_timeline" role="true">Project Timeline</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#participants"
                                       aria-controls="participants" role="tab" aria-expanded="false">Participants</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#forum"
                                       aria-controls="forum" role="tab" aria-expanded="false">Forum</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane animation-fade active" id="project_timeline" role="tabpanel" aria-expanded="false">
                                    <?= $this->render('_timeline', [
                                        'project' => $project,
                                        'timelines' => $projectTimeline
                                    ]) ?>
                                </div>

                                <div class="tab-pane animation-fade" id="participants" role="tabpanel" aria-expanded="false">
                                    <?= $this->render('/tabs/_participants', [
                                        'participants' => $participants,
                                        'additionData' => ['id' => $project->id]
                                    ]) ?>
                                </div>

                                <div class="tab-pane animation-fade" id="forum" role="tabpanel" aria-expanded="false">
                                    <div class="page-main">
                                        <!-- Forum Content Header -->
                                        <div class="page-header">
                                            <h1 class="page-title">Let's discuss the project</h1>
                                            <form class="m-t-20" action="#" role="search">
                                                <div class="input-search input-search-dark">
                                                    <input type="text" class="form-control w-full" placeholder="Search..." name="">
                                                    <button type="submit" class="input-search-btn">
                                                        <i class="icon wb-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Forum Nav -->
                                        <div class="page-nav-tabs">
                                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="active nav-link" data-toggle="tab" href="#forum-newest" aria-controls="forum-newest" aria-expanded="true" role="tab">Newest</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-toggle="tab" href="#forum-activity" aria-controls="forum-activity" aria-expanded="false" role="tab">Activity</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" data-toggle="tab" href="#forum-answer" aria-controls="forum-answer" aria-expanded="false" role="tab">Answer</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Forum Content -->
                                        <div class="page-content tab-content page-content-table nav-tabs-animate">
                                            <div class="tab-pane animation-fade active" id="forum-newest" role="tabpanel">
                                                <table class="table is-indent">
                                                    <tbody>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/1.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Vicinum at aperta, torquem mox doloris illi, officiis.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Herman Beck</span>
                                                                    <span class="started">1 day ago</span>
                                                                    <span class="tags">Themes</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">1</span>
                                                            <span class="unit">Post</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/2.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Moribus ibidem angore, iudiciorumque careret causa verbis aliena.
                                                                    <div class="flags responsive-hide">
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Mary Adams</span>
                                                                    <span class="started">2 days ago</span>
                                                                    <span class="tags">Configuration</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">2</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/3.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Sinat ut miseram voluptatibus compositis quodsi. Quem afflueret.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Caleb Richards</span>
                                                                    <span class="started">3 days ago</span>
                                                                    <span class="tags">Installation</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">3</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/4.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Graeca modice video patre iuste tradidisse molestiae molestia.
                                                                    <div class="flags responsive-hide">
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By June Lane</span>
                                                                    <span class="started">4 days ago</span>
                                                                    <span class="tags">Announcements</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">4</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/5.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Autem omnes is protervi fortitudinis maerores, geometrica statuat.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Edward Fletcher</span>
                                                                    <span class="started">5 days ago</span>
                                                                    <span class="tags">Development</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">5</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/6.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Tuemur geometrica angore haeret rogatiuncula albuci meo etiam.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Crystal Bates</span>
                                                                    <span class="started">6 days ago</span>
                                                                    <span class="tags">Plugins</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">6</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/7.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Caret adoptionem tollitur, agam dixeris respondendum fortunae familias.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Nathan Watts</span>
                                                                    <span class="started">7 days ago</span>
                                                                    <span class="tags">Technical Support</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">7</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/8.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Una veniamus fruentem firmam, explicari laboramus futuris miser.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Heather Harper</span>
                                                                    <span class="started">8 days ago</span>
                                                                    <span class="tags">Code Review</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">8</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/9.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Aristippus dicantur verterem molestiam tali appetendum. Maximis potest.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Willard Wood</span>
                                                                    <span class="started">9 days ago</span>
                                                                    <span class="tags">Responses</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">9</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/10.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Hac ipsa sit, facile liberiusque ipse frustra multo.
                                                                    <div class="flags responsive-hide">
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Ronnie Ellis</span>
                                                                    <span class="started">10 days ago</span>
                                                                    <span class="tags">Package</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">10</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="pagination pagination-gap">
                                                    <li class="disabled page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                                    <li class="active page-item"><a class="page-link" href="javascript:void(0)">1 <span class="sr-only">(current)</span></a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane animation-fade" id="forum-activity" role="tabpanel">
                                                <table class="table is-indent">
                                                    <tbody>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/11.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Repellere summo tritani uterque nullo sollicitudines. Frui lectorem.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Gwendolyn Wheeler</span>
                                                                    <span class="started">1 day ago</span>
                                                                    <span class="tags">Technical Support</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">1</span>
                                                            <span class="unit">Post</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/12.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Malarum beate spe consilia fabulae, intervalla verbum falso.
                                                                    <div class="flags responsive-hide">
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Daniel Russell</span>
                                                                    <span class="started">2 days ago</span>
                                                                    <span class="tags">Plugins</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">2</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/13.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Nomini libris ergo errorem solido sitne oratio, mediocriterne.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Sarah Graves</span>
                                                                    <span class="started">3 days ago</span>
                                                                    <span class="tags">Announcements</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">3</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/14.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Terrore ennius, sumitur tum provincia quae probatum fingi.
                                                                    <div class="flags responsive-hide">
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Andrew Hoffman</span>
                                                                    <span class="started">4 days ago</span>
                                                                    <span class="tags">Installation</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">4</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/15.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Statua iucundius brevis beatam finitas suscipit ipsis incursione.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Camila Lynch</span>
                                                                    <span class="started">5 days ago</span>
                                                                    <span class="tags">Configuration</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">5</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/16.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Laus optime turbulenta carere cotidie deduceret aequo metuamus.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Ramon Dunn</span>
                                                                    <span class="started">6 days ago</span>
                                                                    <span class="tags">Feature Requests</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">6</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/17.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Efficit accusantium voluit quales, legere inmensae. Pariuntur privamur.
                                                                    <div class="flags responsive-hide">
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Scott Sanders</span>
                                                                    <span class="started">7 days ago</span>
                                                                    <span class="tags">Troubleshooting</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">7</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="pagination pagination-gap">
                                                    <li class="disabled page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                                    <li class="active page-item"><a class="page-link" href="javascript:void(0)">1 <span class="sr-only">(current)</span></a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane animation-fade" id="forum-answer" role="tabpanel">
                                                <table class="table is-indent">
                                                    <tbody>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/2.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Augeri, sanos simulent atomi habet ullo consuetudine saepti.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Mary Adams</span>
                                                                    <span class="started">1 day ago</span>
                                                                    <span class="tags">Plugins</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">1</span>
                                                            <span class="unit">Post</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/3.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Odioque denique teneam animis putem torquentur retinere sermone.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Caleb Richards</span>
                                                                    <span class="started">2 days ago</span>
                                                                    <span class="tags">Technical Support</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">2</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/4.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Diligenter accessio meque difficile propemodum posuit momenti impetu.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By June Lane</span>
                                                                    <span class="started">3 days ago</span>
                                                                    <span class="tags">Code Review</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">3</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/5.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Terrore ennius, sumitur tum provincia quae probatum fingi.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Edward Fletcher</span>
                                                                    <span class="started">4 days ago</span>
                                                                    <span class="tags">Troubleshooting</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">4</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/6.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Habere nati sponte dum pericula exorsus sciscat fructuosam.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Crystal Bates</span>
                                                                    <span class="started">5 days ago</span>
                                                                    <span class="tags">Configuration</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">5</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/7.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Nutu fugiendus, accusata utamur iniucundus captet quippe virtutum.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Nathan Watts</span>
                                                                    <span class="started">6 days ago</span>
                                                                    <span class="tags">Announcements</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">6</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    <tr data-url="panel.tpl" data-toggle="slidePanel">
                                                        <td class="pre-cell"></td>
                                                        <td class="cell-60 responsive-hide">
                                                            <a class="avatar" href="javascript:void(0)">
                                                                <img class="img-fluid" src="../../global/portraits/8.jpg" alt="...">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="content">
                                                                <div class="title">
                                                                    Parvos labore efficeret, liber timorem tarentinis accedis praebeat.
                                                                    <div class="flags responsive-hide">
                                                                        <span class="sticky-top tag tag-round tag-danger"><i class="icon wb-dropup" aria-hidden="true"></i>TOP</span>
                                                                        <i class="locked icon wb-lock" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="metas">
                                                                    <span class="author">By Heather Harper</span>
                                                                    <span class="started">7 days ago</span>
                                                                    <span class="tags">Themes</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cell-80 forum-posts">
                                                            <span class="num">7</span>
                                                            <span class="unit">Posts</span>
                                                        </td>
                                                        <td class="suf-cell"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <ul class="pagination pagination-gap">
                                                    <li class="disabled page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                                                    <li class="active page-item"><a class="page-link" href="javascript:void(0)">1 <span class="sr-only">(current)</span></a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div><!-- Second Row -->
            <!-- Personal -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4 col-xl-4">
                <div class="col-xs-12 col-xxl-12 col-xl-12 col-lg-12 ">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row text-xs-center m-b-20">
                                <div class="col-xs-12 ">

                                    <?php if ($project->relation === Project::RELATION_ADMIN): ?>
                                        <?= Html::button('edit',
                                            [
                                                'class' => 'btn btn-block btn-primary btn-outline btn-primary m-b-20',
                                                'data-target' => '#project_edit',
                                                'data-toggle' => 'modal',

                                            ]) ?>
                                        <?= CustomModal::widget([
                                            'type' => 'project_edit',
                                            'model' => $project,
                                            'additionalData' => [
                                                'subscribers' => $potentialSubscribers
                                            ]
                                        ]) ?>
                                    <?php elseif ($project->relation !== Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Follow this project',
                                            ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php elseif ($project->relation === Project::RELATION_PARTICIPANT): ?>
                                        <?= Html::a('<i class="icon wb-chat-group" aria-hidden="true"></i>Unsubscribe this project',
                                            ['/'], ['class' => 'btn btn-block btn-primary']) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Project owners:
                                    </td>
                                    <td>
                                        <?php foreach ($project->owners as $key => $owner): ?>
                                            <?= Html::a($owner->user->full_name,
                                                ['/person/profile', 'id' => $owner->user->id]); ?>
                                            <?= ($key < count($project->owners) - 1) ? ', ' : ''; ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Project name:
                                    </td>
                                    <td>
                                        <?= $project->name ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tags:
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($project->ownTags)) {
                                            foreach ($project->ownTags as $tag) {
                                                echo '<span class="tag tag-round tag-primary">'.
                                                    $tag->tag . '</span> ';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td><?= $project->date ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Project Links:</td>
                                    <td>
                                        <?php if ($project->project_links): ?>
                                            <?php foreach (explode(',', $project->project_links) as $link): ?>
                                                <a href="<?= 'http://www.' . $link ?>"><?= 'http://www.' . $link ?></a>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social share:
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-icon social-facebook"><i class="icon bd-facebook" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-twitter"><i class="icon bd-twitter" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-linkedin"><i class="icon bd-linkedin" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-icon social-instagram"><i class="icon bd-instagram" aria-hidden="true"></i></button>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header card-header-transparent p-20">
                            <h3 class="card-title m-b-0 center">Marketplace</h3>
                        </div>
                        <div class="row p-l-30 p-r-30">
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://stroyday.ru/wp-content/uploads/2015/03/%D0%9F%D0%B0%D1%80%D0%BA%D0%B5%D1%82-%D0%BF%D0%BB%D0%B0%D1%88%D0%BA%D0%B8.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">product №1</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://dkvartnsk.ru/wp-content/uploads/2012/01/L2hvbWUvc2JrcGx1c2MvcHVibGljX2h0bWwvaW1hZ2VzL3N0b3JpZXMvZGVjb3JfNDAuanBn.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">product №2</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://static.jobfine.ru/news/images/plotnik-chto-nuzhno-znat.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">service №1</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
                            </div>
                            <div class="col-sm-6 col-xs-6 m-b-20">
                                <img src="http://www.sewctc.org/uploads/7/6/1/2/7612415/carpenter-new-4.jpg" width="100%" height="100%">
                                <h4 class="font-size-16 m-b-5">service №2</h4>
                                <span>
                          <a href="#"><span>See more</span></a>
                        </span>
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
</div>
