<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Confirm';
$this->params['breadcrumbs'][] = $this->title;

	echo "<h1>Do you want checkin?</h1>\t";
	echo "<form method='POST'>";
	echo "<input type='submit' name='btnYes' value='Yes'>\t";
	echo "<input type='submit' name='btnNo' value='No'>";
	echo "</fomr>";
?>