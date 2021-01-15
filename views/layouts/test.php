<?php
use app\assets\TestAsset;
use yii\helpers\Html;

TestAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
<!--    <base href="/">-->
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
<script>
    // доставание cookie
    function readCookie(name) {
        const matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    ///
    $(document).on('pjax:beforeSend', () => {
        document.body.style.cursor = 'progress';
    });

    $(document).on('pjax:complete', () => {
        document.body.style.cursor = 'default';
        let method = $.pjax.options.type;
        if(method == 'POST'){
            document.getElementById('msg').value = ''; //
            console.log(document.cookie);
        }
        $('#msgs-content').scrollTop($('#msgs-content')[0].scrollHeight);
        let clr = readCookie('user_color');
        console.log(decodeURIComponent(clr));
        document.getElementById('chatform-name').style.color = decodeURIComponent(clr);
    });
    //
    function updateList() {
        $.pjax.defaults.timeout = false;
        $.pjax.reload({
            method: 'get',
            container: '#msgs-content'
        });
    }
    // setInterval(updateList, 5000);
</script>
</body>
</html>
<?php $this->endPage() ?>
