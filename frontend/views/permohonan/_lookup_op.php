<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

?>
<style>
.grid-view td {
    white-space: nowrap;
}
.grid-view th {
    white-space: nowrap;
}
</style>
<?php Pjax::begin(['enablePushState' => false]); ?>
    <div class="row">
        <div class="col-md-12">
            <?php 
            
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'pjax' => true,
                'pjaxSettings' => [
                    'options' => [
                        'enablePushState' => false,
                    ],
                ],
                'export' => false,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'nop',
                        'value' => function ($model) {
                            return $model->kd_propinsi . $model->kd_dati2 . $model->kd_kecamatan . $model->kd_kelurahan . $model->kd_blok . $model->no_urut . $model->kd_jns_op;
                        },
                        'header' => 'NOP',
                    ],
                    'jalan_op',
                    'blok_kav_no_op',
                    'rw_op',
                    'rt_op',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{select}',
                        'buttons' => [
                            'select' => function ($url, $model) {
                                    return Html::button('Pilih', [
                                        'class' => 'btn btn-warning btn-xs btn-block btn-select-op', 
                                        'data-kd_kecamatan' => $model->kd_kecamatan, 
                                        'data-kd_kelurahan' => $model->kd_kelurahan,
                                        'data-kd_blok' => $model->kd_blok,
                                        'data-no_urut' => $model->no_urut,
                                        'data-kd_jns_op' => $model->kd_jns_op,
                                        'data-jalan_op' => $model->jalan_op,
                                    ]
                                );
                            }
                        ],
                        'contentOptions' => [
                            'class' => 'text-center',
                        ]
                    ],
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => false,
                'panel' => [
                    'heading' => false,
                    'type' => 'info',
                    'after' => false,
                    'footer' => '<div class="pull-left">{summary}</div>',
                    'showFooter' => true,
                    'showHeader' => false,
                ],
            ]); 
    
            ?>
        </div>
    </div>
<?php Pjax::end(); ?>
