<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\api\AttributeForm */
/* @var $form ActiveForm */
?>
<div class="api-create-attribute">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- api-create-attribute -->
