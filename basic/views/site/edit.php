<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$id = Yii::$app->request->get("id");
$date = Yii::$app->request->get("date");
?>
<div class = "row">
   <div class = "col-lg-5">
<?php $form= ActiveForm::begin(['id' => 'edit-form']) ;?>
	<?= $form->field($model, 'id')->textInput(['value'=>$id, 'readonly'=>true])?>
	<?= $form->field($model, 'date')->textInput(['value'=>$date, 'readonly'=>true])?>
	<?= $form->field($model, 'checkin')?>
	<?= $form->field($model, 'checkout')?>
	<div class = "form-group">
<?= Html::submitButton('Submit', ['class'=>'btn btn-primary', 'name'=>'insert-button'])?>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>
