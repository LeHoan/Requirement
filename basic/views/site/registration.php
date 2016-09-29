<?php
   use yii\widgets\ActiveForm;
   use yii\helpers\Html;
   //use yii\bootstrap\ActiveForm;
   //use yii\bootstrap\Html;
 ?>
<?php  

    if (Yii::$app->session->hasFlash('success')){
	echo Yii::$app->session->getFlash('success');
    }
?>
<div class="row">
   <div class = "col-lg-5">
      <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>
      <?= $form->field($model, 'user') ?>
      <?= $form->field($model, 'password')->passwordInput() ?>
      <?= $form->field($model, 'repassword')->passwordInput() ?>
      <?= $form->field($model, 'role')->radioList(['0'=>'Staff', '1'=>'Admin'])?>
      <div class = "form-group">
         <?= Html::submitButton('Submit', ['class' => 'btn btn-primary',
            'name' => 'registration-button']) ?>
      </div>
      <?php ActiveForm::end(); ?>
   </div>
</div>
