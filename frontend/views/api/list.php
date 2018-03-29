<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="api-list">

    <?= GridView::widget([
        'id' => 'api-list',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function($model) {
                    return Html::a($model->id, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
            ],
            'title',
            'required_attribute',
            'created_at',
            'updated_at',
            [
                'label' => 'Attributes',
                'value' => function($model) {
                    return GridView::widget([
                        'id' => 'api-list-' . $model->id,
                        'dataProvider' => new ArrayDataProvider([
                            'models' => $model->apiAttributes,
                            'sort' => [
                                'defaultOrder' => [
                                    'id' => SORT_DESC,
                                ],
                            ],
                        ]),
                        'columns' => [
                            [
                                'label' => 'Id',
                                'attribute' => 'attribute0.id',
                            ],
                            [
                                'label' => 'Title',
                                'attribute' => 'attribute0.title',
                            ],
                            [
                                'label' => 'Created At',
                                'attribute' => 'attribute0.created_at',
                            ],
                            [
                                'label' => 'Updated At',
                                'attribute' => 'attribute0.updated_at',
                            ],
                            'value',
                            [
                                'label' => 'Value Created At',
                                'attribute' => 'created_at',
                            ],
                        ],
                    ]);
                },
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div><!-- api-list -->
