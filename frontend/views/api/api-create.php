<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\api\ApiForm */
/* @var $attributes common\models\Attribute */
/* @var $form ActiveForm */
?>
<div class="api-api-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'required_attribute') ?>
        <?= $form->field($model, 'attributeIds')->checkboxList(ArrayHelper::map($attributes, 'id', 'title')); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- api-api-create -->
