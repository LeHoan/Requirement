<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;

$this->title = 'Wellcome';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Wellcome</h1>
<h4>Login mode : Staff
<br>
Name of staff : <?php $session = Yii::$app->session;
	$name = $session->get('user');
	echo $name  ?></h4>
<form method="post">
<ul>
	<strong>History check time</strong>
	<br>
<?php foreach ($list_check as $row): ?>
    <li>
        <?php echo "Date: ".$row['date'] ?>
	<?php echo "<br>In time: ".$row['checkin'] ?>
	<?php echo "Out time: ".$row['checkout']."<br><br>" ?>
    </li>
<?php endforeach; ?>
	<br><input type="submit" name="btnCheck" value="Check in/out">
</ul>
</form>