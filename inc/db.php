<?php
########## MySql details (Replace with yours) #############
$username = "todo_user"; //mysql username
$password = "123"; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'todo_list'; //databasename

//connect to database
$db = new mysqli($hostname, $username, $password, $databasename);


?>