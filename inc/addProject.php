<?php 

include_once("db.php");

if(isset($_POST["nm"]) && strlen($_POST["nm"])>0) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$contentToSave = filter_var($_POST["nm"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); 
	
	// Insert sanitize string in record
	$insert_row = $db->query("INSERT INTO projects(name) VALUES('".$contentToSave."')");

	if($insert_row)
	{

		 //Record was successfully inserted, respond result back to index page
		  	$my_id = $db->insert_id; //Get ID of last inserted row from MySQL
			echo '<div id="project_'.$my_id.'" class="wrap project">';
			echo '<div class="row">';
			echo '<div class="col-xs-1 blue">';
			echo '<p class="icon"></p>';
			echo '</div>';
			echo '<div class="col-xs-9 blue">';
			echo '<p class="top-title"><a href="#" id="editmep_'.$my_id.'">'.$contentToSave.'</a></p>';
			echo '</div>';
			echo '<div class="col-xs-2 blue">';
				echo '<table class="top-ico"><tbody>';
				echo '<tr>';
				echo '<td class="td-edit" width="50%"><a href="#"><img id='.$my_id.' class="editmep" src="img/edit-top.fw.png" /></a>&nbsp;</td>';
				echo '<td width="50%"><a href="#"><img id='.$my_id.' class="deleteme" src="img/delete-top.fw.png" /></a></td>';
				echo '</tr>';
				echo '</tbody></table>';
			echo '</div></div>';
			echo '<div class="row input-line">';
			echo '<div class="col-xs-1 inp text-center">';
			echo '<p class="icon-plus"><img src="img/plus.fw.png" /></p>';
			echo '</div>';
			echo '<div class="col-xs-11 inp">';
			echo '<div class="input-group">';
			echo '<input type="text" class="form-control" name="tx" id="inputText_'.$my_id.'" placeholder="Start typing here to create a text...">';
			echo '<span class="input-group-btn">';
			echo '<button id="addText_'.$my_id.'" class="btn btn-success btn-sm add-task">Add Task</button>';
			echo '</span>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '<div class="row tasks">';
			echo '<table class="sortme" id="render_'.$my_id.'">';
			echo '</table>';
			echo '</div>';
			echo '</div>';
		  	$db->close(); //close db connection

	} else {
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}

?>

