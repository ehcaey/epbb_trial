<?php

use Carbon\Carbon;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permohonan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="permohonan-index">
    <?php Pjax::begin(['enablePushState' => false]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'pjaxSettings'=> [
                'options'=> [
                    'enablePushState' => false,
                ],
            ],
            'hover' => true,
            'containerOptions' => ['responsive' => true],
            'toolbar' => [
                [
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-plus']) .' <b>Permohonan Baru</b>', ['create'], ['class' => 'btn btn-success']),
                ],
                [
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-refresh']) .' Refresh', ['index'], ['class' => 'btn btn-default']),
                ],
            ],
            'columns' => [
                'thn_pelayanan',
                'bundel_pelayanan',
                'no_urut_pelayanan',
                [
                    'attribute' => 'tgl_surat_permohonan',
                    'value' => function ($model) {
                        return Carbon::createFromDate($model->tgl_surat_permohonan)->format('d/m/Y');
                    },
                ],
                [
                    'attribute' => 'jenis_pelayanan',
                    'value' => function ($model) {
                        return $model->detail->jenisPelayanan->nm_jenis_pelayanan;
                    },
                    'header' => 'Jenis Pelayanan',
                ],
            ],
            'panel'=>[
                'type' => GridView::TYPE_DEFAULT, 
                'heading' => $this->title,
                'afterOptions' => [
                    'class' => 'hidden'
                ],
            ],
            'pager' => [
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
                'maxButtonCount' => 10,
            ],   
        ]); ?>

    <?php Pjax::end(); ?>

</div>
