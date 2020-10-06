<style>
    #logo{
        width: 200px;
        height: 100px;
        border: 1px solid #000;
    }

    .logo-displ{
        display: none;
    }
</style>
<div id="logo" class="logo-vis"></div>
<button id="left-togle">click</button>

<script>

    const lbt = document.getElementById('left-togle');
    lbt.onclick = function () {
        const logo = document.getElementById('logo');
        logo.classList.toggle('logo-displ');
    }
</script>
<div style="font-size: 400%"><span class="fa fa-ruble-sign"></span><span class="fab fa-docker" style="font-size: 100px"></span>
    <span class="fa fa-key"></span>
</div>

<?php
use yii\bootstrap4\Alert;
?>
<?php
Alert::begin([
        'options' => [
                'class' => 'alert-warning',
        ]
]);
?>
<h1>TEST</h1>
<?php
Alert::end();
?>
