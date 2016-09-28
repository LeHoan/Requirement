<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Login</h1>
<?php $form = ActiveForm :: begin();?>
	<?= $form->field($model, 'user') ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<div class="form-group">
	<?= Html::submitButton('Login', ['class' =>'btn btn-primary']) ?>
	</div>
<?php ActiveForm::end() ?>