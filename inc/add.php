<?php 

include_once("db.php");

if(isset($_POST["text"]) && strlen($_POST["text"])>0 && isset($_POST["id"]) && strlen($_POST["id"])>0) 
{	//check $_POST["content_txt"] is not empty


	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$textToSave = filter_var($_POST["text"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$idToSave = filter_var($_POST["id"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); 
	
	// Insert sanitize string in record
	$insert_values = $db->query("INSERT INTO tasks(name, project_id) VALUES('".$textToSave."','".$idToSave."')");
	$my_id = $db->insert_id;
	$update_value = $db->query("UPDATE tasks SET `order`=".$my_id." WHERE id=".$my_id."");

	if($insert_values)
	{

		 //Record was successfully inserted, respond result back to index page
		   //Get ID of last inserted row from MySQL
		  echo '<tbody id = "selected_'.$my_id.'">';
		  echo '<tr class="top-bor">';
		  echo '<td class="text-center table-checkbox" width="6%">';
		  echo '<input type="checkbox" name="option" value="check">';
		  echo '</td>';
		  echo '<td class="double-border"></td>';
		  echo '<td class="table-border" width="73%"><span id="editme_'.$my_id.'">'. $textToSave .'</span></td>';
		  echo '<td width="20%">';
		  echo '<table class="edit">';
		  echo '<tr>';
		  echo '<td class="edit-border" width="33%"><img class="moveme" src="img/move.fw.png" /></td>';
		  echo '<td class="edit-border" width="33%"><img class="editme" id="'.$my_id.'" src="img/edit.fw.png" /></td>';
		  echo '<td width="33%"><img class="delme" id="'.$my_id.'" src="img/delete.fw.png" /></td>';
		  echo '</tr>';
		  echo '</table>';
		  echo '</td>';
		  echo '</tr>';
		  echo '</tbody>';


/*		  echo '<div class="select" id="selected_'.$my_id.'">';
		  echo '<div class="col-xs-1 bor">';
		  echo '<input type="checkbox" id="chkbx" aria-label="sss"/></div>';
		  echo '<div class="col-xs-9" id="list">';
		  echo '<p>'. $contentToSave . '</p></div>';
		  echo '<div class="col-xs-2 hide"><p class="text-right"><span class="glyphicon glyphicon-move"></span>';
		  echo ' | <span class="glyphicon glyphicon-pencil"></span>';
		  echo ' | <a class="del_button" href="#" id="'.$my_id.'">';
		  echo '<span class="glyphicon glyphicon-trash"></span></a></p></div>';
		  echo '</div>';*/
		  $db->close(); //close db connection

	} else {
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}

?>

