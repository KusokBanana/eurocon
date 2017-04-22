<?php
/* @var $this yii\web\View */
/* @var $project \frontend\models\Project */
/* @var $participants \frontend\models\Person */
use yii\helpers\Html;

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
            <div class="col-xs-12 col-xxl-9  col-xl-9 col-lg-9">

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
                                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab" aria-expanded="false">Overview</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab" aria-expanded="true">Participants</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#google_contacts" aria-controls="google_contacts" role="tab" aria-expanded="false">Replies</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#test" aria-controls="test" role="tab" aria-expanded="false">Project Timeline</a></li>
                                <li class="dropdown nav-item" role="presentation" style="display: none;">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Contacts </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" data-toggle="tab" href="#all_contacts" aria-controls="all_contacts" role="tab">All Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#my_contacts" aria-controls="my_contacts" role="tab">My Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#google_contacts" aria-controls="google_contacts" role="tab">Google Contacts</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#test" aria-controls="test" role="tab">Test</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane animation-fade" id="all_contacts" role="tabpanel" aria-expanded="false">
                                    <ul class="list-group">
                                        <li class="list-group-item">

                                            <div class="example-wrap">
                                                <h4 class="example-title">Project №1</h4>
                                                <p>Tractat audita quantumcumque atilii, aegritudo neque iactant
                                                    nominata disputari appellantur studiis.</p>
                                                <div class="example">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="javascript:void(0)">
                                                                <img class="media-object" src="http://decoholic.org/wp-content/uploads/2014/12/scandinavian-design-1.jpg" alt="...">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Top Aligned Media</h4>
                                                            <p>Tractat audita quantumcumque atilii, aegritudo neque iactant
                                                                nominata disputari appellantur studiis. Quaeri prospexit
                                                                expectant repugnantiumve inportuno, angore, arbitrarer
                                                                suscipit epularum potiendi, tali copiosae signiferumque
                                                                fingitur cognitione, animumque recte praetore studium.
                                                                Utinam torqueantur aequo sitisque illud fugiat, manilium
                                                                faciendumve ipsi erunt doloris persius difficilem indignius.
                                                                Maximam evolutio repugnantiumve generis splendore diceretur
                                                                quaeso, verbum erga liquidae historiae perfunctio eveniunt,
                                                                concursionibus duce usus disserui declinare angoribus cognitio
                                                                nihilo municipem, iucundo consequuntur bonum occulte quidam,
                                                                comit attingere sollicitare praeterea atqui ceterorum molita,
                                                                inimicus consedit, dominorum dixissem viris disputata,
                                                                de consul, aspernari autem turbulentaeque concordia consentientis
                                                                labor electram, vituperatoribus sapientium.</p>
                                                        </div>
                                                    </div>
                                                    <div class="media m-t-20">
                                                        <div class="media-left media-middle">
                                                            <a href="javascript:void(0)">
                                                                <img class="media-object" src="http://cdn.freshome.com/wp-content/uploads/2012/12/Scandinavian-Interior-Design.jpg" alt="...">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">Middle Aligned Media</h4>
                                                            <p>Suam suscipiantur maius propositum atomi. Quia nondum similia
                                                                accedit tueri iuste, tibique aegritudo quaerenda illa honesto
                                                                dicas poenis dissentientium. Tranquilli suspicio finitas
                                                                usque optime alienus, sentiunt plerumque, laetitiam proprius
                                                                suam maluisti asperiores discordans voluptaria referenda
                                                                inprobitas atomus. Multo provincia conspiratione loquerer
                                                                perspici imperitos, appetendum turpis geometrica singulos
                                                                optimi partiendo. Gerendarum atilii censes nulli stabilitas
                                                                finis falso nusquam ignavia, secumque tertio fruuntur familias
                                                                litteris suscipiantur benivole putat, umbram frustra instructior
                                                                permulta aeternum sermone posset interiret, afferre pararetur
                                                                difficile, delectant simplicem partis finiri locus expetenda
                                                                voluptatem. Dicenda accusantibus doctissimos intellegi
                                                                adversantur egregios nostra veniamus, discordiae dolorem
                                                                amicitias.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </li>
                                    </ul>

                                    <nav>
                                        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                    </nav>
                                </div>
                                <div class="tab-pane animation-fade active" id="my_contacts" role="tabpanel" aria-expanded="true">
                                    <?= $this->render('/tabs/_participants', [
                                        'participants' => $participants,
                                        'additionData' => ['id' => $project->id]
                                    ]) ?>

                                </div>
                                <div class="tab-pane animation-fade" id="google_contacts" role="tabpanel" aria-expanded="false">

                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            <div class="testimonial-content">
                                                <p>Nam nec ante. Sed lacinia, urna non tincidunt mattis,
                                                    tortor neque adipiscing diam, a cursus ipsum ante quis
                                                    turpis. </p>
                                            </div>
                                            <div class="testimonial-image">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img src="../../global/portraits/1.jpg" alt="image">
                                                </a>
                                            </div>
                                            <span class="testimonial-author">Herman Beck</span>
                                            <span class="testimonial-company">Web Designer</span>
                                        </li>


                                        <li class="list-group-item">

                                            <div class="testimonial-content">
                                                <p>Suspendisse in justo eu magna luctus suscipit. Sed lectus.
                                                    Integer euismod lacus luctus magna. </p>
                                            </div>
                                            <div class="testimonial-image">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img src="../../global/portraits/2.jpg" alt="image">
                                                </a>
                                            </div>
                                            <span class="testimonial-author">Mary Adams</span>
                                            <span class="testimonial-company">Videographer</span>
                                        </li>


                                        <li class="list-group-item">

                                            <div class="testimonial-content">
                                                <p>Nulla quis sem at nibh elementum imperdiet. Duis sagittis
                                                    ipsum. Praesent mauris. Fusce nec tellus sed augue
                                                    semper porta.</p>
                                            </div>
                                            <div class="testimonial-image">
                                                <a class="avatar" href="javascript:void(0)">
                                                    <img src="../../global/portraits/3.jpg" alt="image">
                                                </a>
                                            </div>
                                            <span class="testimonial-author">Owen Hunt</span>
                                            <span class="testimonial-company">Wordpress Ninja</span>
                                        </li>
                                    </ul>
                                    <nav>
                                        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                    </nav>
                                </div>
                                <div class="tab-pane animation-fade " id="test" role="tabpanel" aria-expanded="false">

                                    <ul class="list-group">
                                        <li class="list-group-item">

                                            <div class="page-content container">
                                                <!-- Timeline -->
                                                <ul class="timeline timeline-simple">
                                                    <li class="timeline-period">MAY 2017</li>
                                                    <li class="timeline-item">
                                                        <div class="timeline-dot" data-placement="right" data-toggle="tooltip" data-trigger="hover" data-original-title="2 Days ago"></div>
                                                        <div class="timeline-content">
                                                            <div class="card card-shadow">
                                                                <div class="card-img-top cover">
                                                                    <img class="cover-image" src="https://turbo.network/hqroom/image/upload/c_limit,f_auto,h_10000,w_1600/v1488356661/post/337aa063fb17274cd05d1954/3cf2e8af707bf250rGMx2HeQEbamnr9U.jpg" alt="...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-reverse">
                                                        <div class="timeline-dot bg-green-500" data-placement="left" data-toggle="tooltip" data-trigger="hover" data-original-title="2 Days ago"></div>
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
                                                                    <div class="card-actions pull-xs-right">
                                                                        <a href="javascript:void(0)">
                                                                            <i class="icon wb-chat-working" aria-hidden="true"></i>
                                                                            <span>2500</span>
                                                                        </a>
                                                                        <a href="javascript:void(0)">
                                                                            <i class="icon wb-heart" aria-hidden="true"></i>
                                                                            <span>20</span>
                                                                        </a>
                                                                    </div>
                                                                    <a class="btn btn-primary btn-outline card-link" href="javascript:void(0)">Read More</a>
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
                                                                    <div class="card-actions pull-xs-right">
                                                                        <a href="javascript:void(0)">
                                                                            <i class="icon wb-chat-working" aria-hidden="true"></i>
                                                                            <span>2500</span>
                                                                        </a>
                                                                        <a href="javascript:void(0)">
                                                                            <i class="icon wb-heart" aria-hidden="true"></i>
                                                                            <span>20</span>
                                                                        </a>
                                                                    </div>
                                                                    <a class="btn btn-primary btn-outline card-link" href="javascript:void(0)">Read More</a>
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


                                    <nav>
                                        <ul data-plugin="paginator" data-total="50" data-skin="pagination-no-border" class="pagination pagination-no-border"><li class="pagination-prev page-item disabled"><a class="page-link" href="javascript:void(0)" aria-label="Prev"><span class="icon wb-chevron-left-mini"></span></a></li><li class="pagination-items page-item active" data-value="1"><a class="page-link" href="javascript:void(0)">1</a></li><li class="pagination-items page-item" data-value="2"><a class="page-link" href="javascript:void(0)">2</a></li><li class="pagination-items page-item" data-value="3"><a class="page-link" href="javascript:void(0)">3</a></li><li class="pagination-items page-item" data-value="4"><a class="page-link" href="javascript:void(0)">4</a></li><li class="pagination-items page-item" data-value="5"><a class="page-link" href="javascript:void(0)">5</a></li><li class="pagination-next page-item"><a class="page-link" href="javascript:void(0)" aria-label="Next"><span class="icon wb-chevron-right-mini"></span></a></li></ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div><!-- Second Row -->
            <!-- Personal -->
            <div class="col-xs-12 col-xxl-3 col-xl-3 col-lg-3">
                <div class="panel">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Project owner:
                                </td>
                                <td>
                                    Josef Schwaiger

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
                                    <span class="tag tag-round tag-primary">Wood</span>
                                    <span class="tag tag-round tag-primary">House</span>
                                    <span class="tag tag-round tag-primary">Parquet</span>
                                    <span class="tag tag-round tag-primary">high quality</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Date:
                                </td>
                                <td><?= $project->date ?></td>
                            </tr>
                            <tr>
                                <td>SMM share:
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
            <!-- End Personal -->
            <!-- To Do List -->

        </div>
        <!-- End To Do List -->

        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>