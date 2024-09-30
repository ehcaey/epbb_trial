<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Aduan */

$this->title = 'Pengaduan';
$this->params['breadcrumbs'][] = ['label' => 'Aduans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aduan-create">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', compact('model', 'modelBalasan', 'modelAttach', 'modelUser')); ?>
        </div>
    </div>

</div>
