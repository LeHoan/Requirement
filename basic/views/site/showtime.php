<?php



foreach($users as $user){


?>

<h1><a href="index.php?r=site%2Fdetail&id=<?php echo $user["id"]?>&name=<?php echo $user["user"]?>"> <?php echo $user["user"]?></a></h1>

<?php

}


?>

