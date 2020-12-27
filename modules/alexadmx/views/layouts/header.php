<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

$user = strtolower(Yii::$app->user->identity->username);

$session = Yii::$app->session;

$newPostCount = $session->get('newPostCount');
$newCallCount = $session->get('newCallCount');

$allPostCount = $session->get('allPostCount');
$allCallCount = $session->get('allCallCount');
?>

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
                    <a class="nav-link" href="/user/logout" data-method="post">выйти</a>
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
<script>
    $('[data-toggle="tooltip"]').tooltip();
    // $('#test1').tooltip();
</script>
