<?php

require_once("inc/validate.php"); 
require_once("inc/db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple TODO Lists</title>

    <!-- Bootstrap -->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/custom.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <!-- Content goes here -->
      <div class="wrap">
      	<div class="row text-center">

          <button id="addProject" class="btn btn-success">
              <img class="icon-project-button" src="img/plus-project.fw.png" />Add Project
          </button><br /><br />
          

          <div id="sql-result" class="hide row text-left">
            

          </div>
            <button id="get-all-statuses" class="btn btn-success">
                <img class="icon-project-button" src="img/plus-project.fw.png" />SQL Queries
            </button><br /><br />

          
            
          
      	</div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/my.js"></script>
  </body>
</html>