<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Wellcome';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Wellcome</h1>
Login mode : Staff
<br>
Name of staff : <?php echo Yii::$app->request->get('name') ?>
<br>
<br>
<form method="post">
<input type="submit" name="btnShow" value="Show Check times">
<input type="submit" name="btnCheck" value="Check in/out">
</form>