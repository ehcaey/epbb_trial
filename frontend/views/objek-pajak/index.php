<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Objek Pajak';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dat-objek-pajak-index">
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
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-plus']) .' <b>Tambah</b>', ['create'], ['class' => 'btn btn-success']),
                ],
                [
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-refresh']) .' Refresh', ['index'], ['class' => 'btn btn-default']),
                ],
            ],
            'columns' => [
                [
                    'attribute' => 'nop',
                    'value' => function ($model) {
                        return $model->kd_propinsi . $model->kd_dati2 . $model->kd_kecamatan . $model->kd_kelurahan . $model->kd_blok . $model->no_urut . $model->kd_jns_op;
                    },
                    'header' => 'NOP',
                ],
                // 'kd_blok',
                //'no_urut',
                //'kd_jns_op',
                //'subjek_pajak_id',
                'no_formulir_spop',
                // 'no_persil',
                'jalan_op',
                'blok_kav_no_op',
                'rw_op',
                'rt_op',
                //'kd_status_cabang',
                //'kd_status_wp',
                'total_luas_bumi',
                'total_luas_bng',
                // 'njop_bumi',
                // 'njop_bng',
                //'status_peta_op',
                //'jns_transaksi_op',
                //'tgl_pendataan_op',
                //'nip_pendata',
                //'tgl_pemeriksaan_op',
                //'nip_pemeriksa_op',
                //'tgl_perekaman_op',
                //'nip_perekam_op',
                
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Hapus',
                    'template' => '{delete}',
                    'buttonOptions' => ['class' => 'text-danger'],
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
