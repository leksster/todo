<?php 

require_once('db.php');

$list = $_POST['selected'];
$count = 0;
foreach ($list as $realid) {
	$sort = $db->query("UPDATE tasks SET `order`='$count' WHERE id = '$realid'");
	$count--;
}
/*$sort = $db->query("UPDATE ord SET `text`='$contentToSave.' WHERE id = 3");*/

?>