<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ketetapan & Piutang';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ketetapan-piutang-index">
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
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-refresh']) .' Refresh', ['index'], ['class' => 'btn btn-default']),
                ],
            ],
            'columns' => [
                [
                    'attribute' => 'nop',
                    'value' => function ($model) {
                        return Html::a('<strong>' . $model->nop . '</strong>', ['view',
                            'kd_propinsi' => $model->kd_propinsi,
                            'kd_dati2' => $model->kd_dati2,
                            'kd_kecamatan' => $model->kd_kecamatan,
                            'kd_kelurahan' => $model->kd_kelurahan,
                            'kd_blok' => $model->kd_blok,
                            'no_urut' => $model->no_urut,
                            'kd_jns_op' => $model->kd_jns_op,
                        ]);
                    },
                    'header' => 'NOP',
                    'format' => 'raw',
                ],
                'jalan_op',
                'blok_kav_no_op',
                'rw_op',
                'rt_op',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => '',
                    'width' => '10%',
                    'template' => '{view}',
                    'buttonOptions' => ['class' => 'text-primary'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-eye']) . ' Lihat', ['view',
                                'kd_propinsi' => $model->kd_propinsi,
                                'kd_dati2' => $model->kd_dati2,
                                'kd_kecamatan' => $model->kd_kecamatan,
                                'kd_kelurahan' => $model->kd_kelurahan,
                                'kd_blok' => $model->kd_blok,
                                'no_urut' => $model->no_urut,
                                'kd_jns_op' => $model->kd_jns_op,
                            ]);
                        }
                    ],
                    'header' => 'Detail',
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
