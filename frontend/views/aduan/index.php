<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjekPajakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengaduan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pengaduan-index">
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
                    'attribute' => 'subjek',
                    'content' => function ($model) {
                        return Html::a($model->subjek, ['aduan/update?id=' . $model->id]);
                    },
                    'header' => 'Subjek',
                ],
                [
                    'attribute' => 'status',
                    'contentOptions' => ['class' => 'text-center'],
                    'content' => function ($model) {
                        if($model->status == '1'){
                            $button = Html::a('Proses', ['aduan/update?id=' . $model->id], ['class' => 'btn btn-default btn-sm', 'style' => 'width:80%;']);
                        }else{
                            $button = Html::a('Ditutup', ['aduan/update?id=' . $model->id], ['class' => 'btn btn-default btn-sm', 'style' => 'width:80%;']);
                        }
                        return $button;
                    },
                    'header' => 'Status',
                ],
                [
                    'attribute' => 'updatedtime',
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => ['date', 'php:d/m/Y (H:i:s)']

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
