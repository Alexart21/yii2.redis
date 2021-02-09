<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Alert;
use app\assets\AdminLteAsset;

AdminLteAsset::register($this);

$user = strtolower(Yii::$app->user->identity->username);

$session = Yii::$app->session;

$newPostCount = $session->get('newPostCount');
$newCallCount = $session->get('newCallCount');

$allPostCount = $session->get('allPostCount');
$allCallCount = $session->get('allCallCount');
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" type="image/png" href="/icons/64x64.png" />
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <!--LOADER-->
    <div id="loader">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px"
             width="70px" height="70px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;"
             xml:space="preserve">
  <path fill="#e61b05"
        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
  </path>
  </svg>
    </div>
    <!---->
    <div class="wrapper">
        <!-- Start HEADER -->
        <header class="main-header">

            <?= Html::a('<span class="logo-mini">&copy;</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

            <nav class="navbar navbar-expand-md navbar-light navbar-static-top">
                <!-- Sidebar toggle button
                Отсебятина
                -->
                <style>
                    .sidebar-toggle:before{
                        content: none !important;
                    }
                </style>
                <a href="#" id="left-togle" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <i class="fa fa-align-justify"></i>
                </a>
                <!---->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto py-4 py-md-0">
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a title="на сайт" class="nav-link" href="/"><i class="fa fa-home" style="font-size: 30px;color: #fff"></i></a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx">главная</a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx/post" data-toggle="tooltip" title="Непрочитанных : <?= $newPostCount ?> Всего : <?= $allPostCount ?>">
                                <i class="fa fa-envelope" style="font-size: 30px"></i>
                                <?php
                                $p = empty($newPostCount) ? null : $newPostCount;
                                ?>
                                <span id="post" class="db-count" style="transform: scale(2)"><?= $p ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/alexadmx/callback" data-toggle="tooltip" title="Непрочитанных : <?= $newCallCount ?> Всего : <?= $allCallCount ?>">
                                <i class="fa fa-phone" style="font-size: 30px"></i>
                                <?php
                                $c = empty($newCallCount) ? null : $newCallCount;
                                ?>
                                <span id="callback" class="db-count" style="transform: scale(1.5)"><?= $c ?></span>
                            </a>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <h4 class="nav-link" style="background: #fff;height: 100%"><?= $user ?></h4>
                        </li>
                        <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                            <a class="nav-link" href="/user/logout" data-method="post"><span title="выйти" class="fa fa-external-link-alt"></span></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <?php Pjax::begin(
            [
                'clientOptions' => [
                    'method' => 'GET',
                    'data-pjax-container' => '#modal',
                ],
                'enablePushState' => false, // не обновлять url
                'linkSelector' => '.pjax', //обрабатывать через pjax только отдельные ссылки
                'timeout' => '20000',
            ]);
        ?>
        <output id="modal"></output>
        <?php Pjax::end(); ?>
        <!-- END HEADER -->
        <!-- START LEFT-SIDEBAR -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <img id="logo" src="/web/img/main_img/logo.png" class="logo-displ">
                <br>
                <a href="/alexadmx/post" title="письма"><span class="fa fa-envelope"></span></a>
                <a href="/alexadmx/callback" title="заказы обратных звонков"><span class="fa fa-phone"></span></a>
                <a href="/alexadmx/default/phpinfo" title="phpinfo"><span class="fab fa-php"></span></a>
            </section>
        </aside>
        <!-- END LEFT-SIDEBAR -->
        <!-- START CONTENT -->
        <div class="content-wrapper">
            <section class="content">
                <section class="content-header">
                    <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Главная', 'url' => '/alexadmx/'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </section>
                <?= Alert::widget() ?>
                <div id="main-content">
                    <?= $content ?>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong class="company"><?= Yii::$app->params['company'] ?></strong><sup>&copy;</sup> web developer group 2009&mdash;<?= date('Y') ?> тел. <strong
                    class="corpid"><?= Yii::$app->params['tel1'] ?></strong><br/>
            <strong>Создание и продвижение сайтов в Чебоксарах</strong><br/>
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class='control-sidebar-menu'>
                        <li>
                            <a href='javascript::;'>
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class='control-sidebar-menu'>
                        <li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-waring pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href='javascript::;'>
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>
                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked/>
                            </label>
                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked/>
                            </label>
                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked/>
                            </label>
                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>
                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked/>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right"/>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
        <div class='control-sidebar-bg'></div>
        <!-- END CONTENT -->
    </div>
    <?php $this->endBody() ?>
    <script>
        $(document).on('pjax:beforeSend', function () {
            document.body.style.cursor = 'progress';
            $('#loader').css('visibility', 'visible');
        });

        $(document).on('pjax:complete', function () {
            document.body.style.cursor = 'default';
            $('#loader').css('visibility', 'hidden');
        });
        // отсебятина. По клику скрываем лого в левом сайдбаре
        const lbt = document.getElementById('left-togle');
        lbt.onclick = function () {
            const logo = document.getElementById('logo');
            logo.classList.toggle('logo-displ');
        }
        ////
        const alrt = document.querySelector('.alert');
        // console.log(alrt);
        if(alrt){
            setTimeout(function() {
                alrt.remove();
            }, 4000);
            /*setTimeout(function() {
                $('.alert').modal('hide');
            }, 4000);*/
        }
    </script>
    </body>
    </html>
<?php $this->endPage() ?>