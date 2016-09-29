<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;

$this->title = 'Time of logs';
?>
Time logs of <?php echo Yii::$app->request->get('name') ?>
<form method="post">
<ul>
<?php foreach ($list_check as $row): ?>
    <li>
        <?php echo "Date: ".$row['date'] ?>
	<?php echo "In time: ".$row['checkin'] ?>
	<?php echo "Out time: ".$row['checkout'] ?>
    </li>
<?php endforeach; ?>
	<input type="submit" name="btnBack" value="Back">
</ul>
</form>