<?php
$id = Yii::$app->request->get("id");
$name = Yii::$app->request->get("name");
?>
<form method="post" action="index.php?r=site%2Finsert&id=<?=$id?>">
<input type="hidden" value="<?=$id?>" />
<h1>Information of <?php echo $name?></h1>
<h3>
<table border="1">
<tr>
	<th>Date</th>
	<th>CheckIn</th>
	<th>CheckOut</th>
</tr>
<?php
foreach($users as $user) {


?>
<tr>
	<td><?php echo $user["date"]?></td>
	<td><?php echo $user["checkin"]?></td>
	<td><?php echo $user["checkout"]?></td>
	<td><a href="index.php?r=site%2Fedit&id=<?php echo $id?>&date=<?php echo $user["date"]?>">Edit</a></td>
</tr>
<?php
}

?>
</table>
</h3>
<input type="submit" value="Insert" name="btnInsert">
</form>
<form method="post">
<input type="submit" value="Export TimeSheet" name="btnExport">
</form>
<!--
<a href="index.php?r=site%2Finsert&id=<?=$id?>">Insert</a>
<a href="index.php?r=site%2Fexport&id=<?=$id?>">Export</a>
-->
<?php
if(isset($_POST["btnExport"])) {
$totalWorking = date("H:i:s", mktime(0,00,00)); 
foreach($users as $user) {
$hourWorking = $user["checkout"]-$user["checkin"] - 1; 
$totalWorking += $hourWorking; 
}
echo $totalWorking; 

$d=mktime(8, 30, 00);
$v=mktime(17, 30, 00);
$s = date("H:i:s", $d);
$c = date("H:i:s", $v);
$totalLeave = 0;
foreach($users as $user) {
if($user["checkin"] > $s) {
$hourLeave1 = $user["checkin"] - $s; 
} elseif ($user["checkout"] < $c) {
$hourLeave2 = $c - $user["checkout"];
} 
$totalLeave = $hourLeave1 + $hourLeave2;
}

/*
//export timesheet ti csv file
$fp = fopen("/var/www/html/Requirement/basic/views/site/timestamps.csv","w")or die("Unable to open file!");
$seperator = "";
$comma ="";
foreach($users as $user) {
    for($i = 0 ; $i < count(array_keys($user)) ; $i++) {
    $seperator .= $comma . '' .str_replace('','""',array_keys($user)[$i]);
    $comma = ",";
}
}
$seperator .= "\n";

fputs($fp,$seperator);

foreach($users as $user) {
$seperator = "";
$comma ="";
foreach($user as $value) {
    $seperator .= $comma . '' .str_replace('','""',$value);
    $comma = ",";
}
$seperator .= "\n";
//echo $seperator; die();
fputs($fp,$seperator);
}

//total working hours of month
*/
}
?>
