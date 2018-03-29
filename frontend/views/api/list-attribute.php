<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="api-list-attribute">

    <?= GridView::widget([
        'id' => 'api-list',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function($model) {
                    return Html::a($model->id, ['update-attribute', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            'title',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div><!-- api-list-attribute -->
