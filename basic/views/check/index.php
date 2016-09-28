<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Check times of <?php Yii::$app->request->get('name') ?></h1>
<ul>
<?php foreach ($list_check as $row): ?>
    <li>
        <?php echo $row['date'] ?>
	<?php echo $row['checkin'] ?>
	<?php echo $row['checkout'] ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>