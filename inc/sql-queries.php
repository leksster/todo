<?php 

require_once("db.php");

$get_all_statuses = $db->query("SELECT status FROM tasks GROUP BY status ORDER BY status ASC");
$count_tasks = $db->query("SELECT COUNT(tasks.name) AS count, projects.name AS name FROM tasks JOIN projects ON projects.id = tasks.project_id GROUP BY tasks.project_id ORDER BY count DESC");
$count_tasks_by_names = $db->query("SELECT COUNT(tasks.name) AS count, projects.name AS name FROM tasks JOIN projects ON projects.id = tasks.project_id GROUP BY tasks.project_id ORDER BY name ASC");
$capital_n = $db->query("SELECT * FROM `tasks` WHERE name LIKE BINARY 'N%'");
$a_letter = $db->query("SELECT projects.name AS name, COUNT(tasks.name) AS count FROM tasks JOIN projects ON tasks.name LIKE '%a%' AND projects.id = tasks.project_id GROUP BY projects.name");
$duplicate = $db->query("SELECT name, COUNT(name) FROM tasks GROUP BY name HAVING COUNT(name) > 1 ORDER BY name ASC");
$ten_completes = $db->query("SELECT projects.name, COUNT(tasks.status), COUNT(CASE WHEN tasks.status = 1 THEN 'V' ELSE NULL END) AS count_of_completed FROM projects JOIN tasks ON projects.id = tasks.project_id GROUP BY projects.name HAVING count_of_completed >= 10 ORDER BY projects.id");



if(isset($get_all_statuses)) {	

	echo "<p>Get all statuses, not repeating, alphabetically ordered</p>";
	while ($row = $get_all_statuses->fetch_assoc()) {
		echo '<p class="returned-result">'.$row['status'].'</p>';
	}
	
	$db->close(); //close db connection
}

if (isset($count_tasks)) {
	echo '<p>Get the count of all tasks in each project, order by tasks count descending</p>';
	while ($row = $count_tasks->fetch_assoc()) {
		
		echo '<p class="returned-result">'.$row['count'].' ---> '.$row['name'].'</p>';
	}
}

if (isset($count_tasks_by_names)) {
	echo '<p>Get the count of all tasks in each project, order by projects names</p>';
	while ($row = $count_tasks_by_names->fetch_assoc()) {
		
		echo '<p class="returned-result">'.$row['count'].' ---> '.$row['name'].'</p>';
	}
}

if (isset($capital_n)) {
	echo '<p>Get the tasks for all projects having the name beginning with “N” letter</p>';
	while ($row = $capital_n->fetch_assoc()) {

		echo '<p class="returned-result">'.$row['name'].'</p>';
	}
}

if (isset($a_letter)) {
	echo '<p>Get the list of all projects containing the ‘a’ letter in the middle of the name, and show the tasks count near each project. Mention that there can exist projects without tasks and tasks with project_id=NULL</p>';
	while ($row = $a_letter->fetch_assoc()) {

		echo '<p class="returned-result">'.$row['name'].' ---> '.$row['count'].'</p>';
	}
}

if (isset($duplicate)) {
	echo '<p>Get the list of tasks with duplicate names. Order alphabetically</p>';
	echo '<ol>';
	while ($row = $duplicate->fetch_assoc()) {

		echo '<li class="returned-result">'.$row['name'].'</li>';
	}
	echo '</ol>';
}

if (isset($ten_completes)) {
	echo '<p>Get the list of project names having more than 10 tasks in status ‘completed’. Order by project_id</p>';
	echo '<ol>';
	while ($row = $ten_completes->fetch_assoc()) {

		echo '<li class="returned-result">'.$row['name'].'</li>';
	}
	echo '</ol>';
}

else

{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}

echo ("");

?>