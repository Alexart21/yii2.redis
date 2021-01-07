<?php
use yii\helpers\Html;

$this->title = $name;

// шаблон здесь
$this->context->layout = 'error';
?>
<div class="site-error">

    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <div>
        <h2 style="color: #000;text-shadow: .5px .5px red;letter-spacing: 1px;text-align: center"><span><?= nl2br(Html::encode($message)) ?></span></h2>
    </div>
</div>
