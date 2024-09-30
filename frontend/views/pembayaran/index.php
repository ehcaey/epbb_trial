<?php

use Carbon\Carbon;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VirtualAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="virtual-account-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'hover' => true,
            'containerOptions' => ['responsive' => true],
            'toolbar' => [
                [
                    'content'=> Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-refresh']) .' Refresh', ['index'], ['class' => 'btn btn-default']),
                ],
            ],
            'columns' => [
                [
                    'attribute' => 'no_va',
                    'vAlign' => 'middle',
                ],
                [
                    'attribute' => 'nop',
                    'value' => function ($model) {
                        return $model->kd_propinsi . $model->kd_dati2 . $model->kd_kecamatan . $model->kd_kelurahan . $model->kd_blok . $model->no_urut . $model->kd_jns_op;
                    },
                    'header' => 'NOP',
                    'vAlign' => 'middle',
                ],
                [
                    'attribute' => 'alamat_op',
                    'vAlign' => 'middle',
                ],
                [
                    'attribute' => 'tgl_pembayaran',
                    'value' => function ($model) {
                        return number_format($model->tagihan, 0, ',', '.');
                    },
                    'header' => 'Tagihan (Rp.)',
                    'vAlign' => 'middle',
                ],
                [
                    'attribute' => 'tgl_pembayaran',
                    'value' => function ($model) {
                        if ($model->tgl_pembayaran != null) {
                            return Carbon::createFromFormat('Y-m-d H:i:s', $model->tgl_pembayaran)->format('d/m/Y');
                        } else {
                            return '';
                        }
                    },
                    'header' => 'Tanggal Pembayaran',
                    'vAlign' => 'middle',
                ],
                [
                    'attribute' => 'status_pembayaran',
                    'value' => function ($model) {
                        if ($model->status_pembayaran == 1) {
                            return 'Lunas';
                        } else {
                            return 'Belum Lunas';
                        }
                    },
                    'header' => 'Status',
                    'vAlign' => 'middle',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Bukti Pembayaran',
                    'template' => '{download}',
                    'buttonOptions' => ['class' => 'text-primary'],
                    'buttons' => [
                        'download' => function ($url, $model) {
                            return ($model->status_pembayaran == 1) ? Html::a(Html::tag('i', '', ['class' => 'fa fa-fw fa-download']), Url::to('/pembayaran/bukti-pembayaran?nova=' . $model->no_va), ['target' => '_blank']) : '';
                        }
                    ],
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Detail',
                    'template' => '{view}',
                    'buttonOptions' => ['class' => 'text-primary'],
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
</div>
