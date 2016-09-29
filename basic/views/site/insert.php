<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$id = Yii::$app->request->get("id");

?>
<div class = "row">
   <div class = "col-lg-5">
      <?php $form = ActiveForm::begin(['id' => 'insert-form']); ?>
      <?= $form->field($model, 'id')->hiddenInput(['value'=> $id])->label(false) ?>
      <?= $form->field($model, 'date') ?>
      <?= $form->field($model, 'checkin') ?>
      <?= $form->field($model, 'checkout') ?>
      
      <div class = "form-group">
         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary',
            'name' => 'insert-button']) ?>
      </div>
      <?php ActiveForm::end(); ?>
   </div>
</div>
