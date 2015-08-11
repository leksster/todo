<?php 

	require_once("db.php");
	$tasks = $db->query("SELECT * FROM tasks ORDER BY `order` DESC");
	$projects = $db->query("SELECT * FROM projects ORDER BY `id` DESC");

	$tArr = array();
	while ($row = $tasks->fetch_assoc()) {
		$tArr[] = $row;
	}
	while ($row = $projects->fetch_assoc()) {
		echo '<div id="project_'.$row['id'].'" class="wrap project">';
		echo '<div class="row">';
		echo '<div class="col-xs-1 blue">';
		echo '<p class="icon"></p>';
		echo '</div>';
		echo '<div class="col-xs-9 blue">';
		echo '<p class="top-title"><a href="#" id="editmep_'.$row['id'].'">'.$row['name'].'</a></p>';
		echo '</div>';
		echo '<div class="col-xs-2 blue">';
			echo '<table class="top-ico"><tbody>';
			echo '<tr>';
			echo '<td class="td-edit" width="50%"><a href="#"><img id='.$row['id'].' class="editmep" src="img/edit-top.fw.png" /></a>&nbsp;</td>';
			echo '<td width="50%"><a href="#"><img id='.$row['id'].' class="deleteme" src="img/delete-top.fw.png" /></a></td>';
			echo '</tr>';
			echo '</tbody></table>';
		echo '</div></div>';
		echo '<div class="row input-line">';
		echo '<div class="col-xs-1 inp text-center">';
		echo '<p class="icon-plus"><img src="img/plus.fw.png" /></p>';
		echo '</div>';
		echo '<div class="col-xs-11 inp">';

		echo '<div class="input-group">';
		echo '<input type="text" class="form-control" name="tx" id="inputText_'.$row['id'].'" placeholder="Start typing here to create a text...">';
		echo '<span class="input-group-btn">';
		echo '<button id="addText_'.$row['id'].'" class="btn btn-success btn-sm add-task">Add Task</button>';
		echo '</span>';
		echo '</div>';

		echo '</div>';
		echo '</div>';
		echo '<div class="row tasks">';
		echo '<table class="sortme" id="render_'.$row['id'].'">';

		foreach ($tArr as $assoc) {
			if ($assoc['project_id'] === $row['id']) {
				if ($assoc['status'] == 1) {
					$checked = 'strike';
				} else {
					$checked = '';
				}
				
				echo '<tbody class="'.$checked.'" id="selected_'.$assoc['id'] .'">';
				echo '<tr class="top-bor">';
				echo '<td class="text-center table-checkbox" width="6%">';
				echo '<input type="checkbox" name="option" value="check">';
				echo '</td>';
				echo '<td class="double-border"></td>';
				echo '<td class="table-border" width="73%"><span id="editme_'.$assoc['id'].'">'. $assoc['name'] .'</span></td>';
				echo '<td width="20%">';
				echo '<table class="edit">';
				echo '<tr>';
				echo '<td class="edit-border" width="33%"><img class="moveme" id="movemee" src="img/move.fw.png" /></td>';
				echo '<td class="edit-border" width="33%"><img class="editme" id="'.$assoc['id'].'" src="img/edit.fw.png" /></td>';
				echo '<td width="33%"><img class="delme" id="'.$assoc['id'].'" src="img/delete.fw.png" /></td>';
				echo '</tr>';
				echo '</table>';
				echo '</td>';
				echo '</tr>';
				echo '</tbody>';
			}
		}

		echo '</table>';
		echo '</div>';
		echo '</div>';


	}


?>