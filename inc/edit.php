<?php 

include_once("db.php");


if(isset($_POST["ed"]) && strlen($_POST["ed"])>0 && isset($_POST["id"]) && strlen($_POST["id"])>0) 
{	//check $_POST["content_txt"] is not empty


	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$textToSave = filter_var($_POST["ed"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$idToSave = filter_var($_POST["id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); 
	
	// Insert sanitize string in record

	$insert_values = $db->query("UPDATE tasks SET name = '$textToSave' WHERE id = '$idToSave'");


	if($insert_values)
	{
		echo $_POST['ed'];

		 //Record was successfully inserted, respond result back to index page


	} else {
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}

if(isset($_POST["edp"]) && strlen($_POST["edp"])>0 && isset($_POST["id"]) && strlen($_POST["id"])>0) 
{	//check $_POST["content_txt"] is not empty


	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$textToSave = filter_var($_POST["edp"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$idToSave = filter_var($_POST["id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); 
	
	// Insert sanitize string in record

	$insert_values = $db->query("UPDATE projects SET name = '$textToSave' WHERE id = '$idToSave'");


	if($insert_values)
	{
		echo $_POST['edp'];

		 //Record was successfully inserted, respond result back to index page


	} else {
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}

?>

