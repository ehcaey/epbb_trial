<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SubjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subjek Pajaks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjek-pajak-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Subjek Pajak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subjek_pajak_id',
            'nm_wp',
            'jalan_wp',
            'blok_kav_no_wp',
            'rw_wp',
            //'rt_wp',
            //'kelurahan_wp',
            //'kota_wp',
            //'kd_pos_wp',
            //'telp_wp',
            //'npwp',
            //'status_pekerjaan_wp',
            //'createdby',
            //'createdtime',
            //'updatedby',
            //'updatedtime',
            //'handphone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
