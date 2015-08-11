var main = function() {

	//Render + sort

	$.ajax({
	type: "GET",
	url: "inc/action.php"
	}).done(function(data) {
		$('.container').prepend(data);
		$('.sortme').sortable({
			axis: 'y',
			handle: '.moveme',
			update: function(event, ui) {
				var data = $(this).sortable('serialize');
				//post to server using $.post
					$.ajax({
					data: data,
					type: 'POST',
					url: 'inc/sort.php',				
					success: function(response) {
						$('.tasks').append(response);
						}
					});

				},
			});
		});

	//Add a project

	$('#addProject').click(function() {
		var inputName = prompt("Please enter the name of new project");
		if (inputName != null) {
			var projectName = 'nm='+inputName;
			$.ajax({
				type: "POST", // HTTP method POST or GET
				url: "inc/addProject.php", //Where to make Ajax calls
				dataType:"text", // Data type, HTML, json etc.
				data: projectName, //Form variables
				success:function(response){
					$(".container").prepend(response);
					$(window).scrollTop(0);
				},

				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		};
		
	});


	// Add a task

	$("body").on("click keydown", ".add-task", function(e) {
		var clickedID = this.id;
		var cleanID = clickedID.slice(8);
		var inpTextId = '#inputText_' + cleanID;
		var renderId = '#render_' + cleanID;

		var inpData = 'text='+ $(inpTextId).val() +'&id='+cleanID; //build a post data structure
		$.ajax({
			type: "POST", // HTTP method POST or GET
			url: "inc/add.php", //Where to make Ajax calls
			dataType: "text", // Data type, HTML, json etc.
			data: inpData, //Form variables
			success:function(response){
				$(renderId).prepend(response);
				$("#inputText_" + cleanID).val('');
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	});

	// Add task on ENTER

	$("body").on("keydown", ".form-control", function(e) {
		if (e.which == '13') {	
			var clickedID = this.id;
			var cleanID = clickedID.slice(10);
			var inpTextId = '#inputText_' + cleanID;
			var renderId = '#render_' + cleanID;

			var inpData = 'text='+ $(inpTextId).val() +'&id='+cleanID; //build a post data structure
			$.ajax({
				type: "POST", // HTTP method POST or GET
				url: "inc/add.php", //Where to make Ajax calls
				dataType: "text", // Data type, HTML, json etc.
				data: inpData, //Form variables
				success:function(response){
					$(renderId).prepend(response);
					$("#inputText_" + cleanID).val('');
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	});

	// Del a task	

	$("body").on("click", ".tasks .delme", function() {
		 
		var clickedID = this.id;
		var myData = 'recordToDelete='+ clickedID; //build a post data structure
		 
		jQuery.ajax({
		type: "POST", // HTTP method POST or GET
		url: "inc/del.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
		success:function(response){
			$('.tasks').prepend(response);
			//on success, hide  element user wants to delete.
			$('#selected_'+clickedID).fadeOut();
		},
		error:function (xhr, ajaxOptions, thrownError){
			//On error, we alert user
			alert(thrownError);
		}
		});
	});

	// Delete a project

	$("body").on("click", ".project .deleteme", function() {
		 
		var clickedID = this.id;
		var myData = 'recordToDelete='+ clickedID; //build a post data structure
		 
		jQuery.ajax({
		type: "POST", // HTTP method POST or GET
		url: "inc/delProject.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
		success:function(response){
			$('.tasks').prepend(response);
			//on success, hide  element user wants to delete.
			$('#project_'+clickedID).fadeOut();
		},
		error:function (xhr, ajaxOptions, thrownError){
			//On error, we alert user
			alert(thrownError);
		}
		});
	});

	//Change status

	$("body").on("click", "tbody .table-border", function() {
		var ok = ($(this).closest('tbody'));
		var id = (ok[0].id);
		var cleanID = id.substring(9);
		

		$('#'+id).toggleClass('strike');

		if ($('#'+id).hasClass('strike')) {

			var check = 'id='+cleanID + '&' + 'uncheck=' + 1;
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "inc/check.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:check, //Form variables
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});	

		} else {
			var uncheck = 'id='+cleanID + '&' + 'uncheck=' + 0;
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "inc/check.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:uncheck, //Form variables
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});	
		};
	});


	$('div.blue')
	.mouseenter(function() {
		$('.editme').removeClass('hide');
		$('#tr').removeClass('hide');
	})
	.mouseleave(function() {
		$('.glyphicon-edit').addClass('hide');
		$('#tr').addClass('hide');
	});

	$('body').on({
		mouseenter: function() {
			$('.col-xs-2', this).removeClass('hide');
			$(this).addClass('selected');
		},
		mouseleave: function() {
			$('.col-xs-2', this).addClass('hide');
			$(this).removeClass('selected');
		},
		click: function() {
			var checkbox = $('#chkbx', this);
			if (checkbox.is(':checked')) {
				$('p', this).removeClass('done');
				checkbox.prop('checked', false);
			} else {
				$('p', this).addClass('done');
				checkbox.prop('checked', true);
			}
		}
	}, ".select");


	$('#addText').addClass('disabled');



	// EDIT task name

	$('body').on('click', '.editme', function() {
		var itemId = this.id;
		var userText = prompt("Please edit this entry");
		var editQ = "ed=" + userText + '&id=' + itemId;

		if (userText != null) {
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "inc/edit.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:editQ, //Form variables
			success:function(response){
				if (response.length>0) {
					console.log(response);
					$('#editme_'+itemId).text(response);
				};
				
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
		};
	});

	// EDIT Project name

	$('body').on('click', '.editmep', function() {
		var itemId = this.id;
		var userText = prompt("Please edit this entry");
		var editQ = "edp=" + userText + '&id=' + itemId;
		if (userText != null) {
			console.log(userText);
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "inc/edit.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:editQ, //Form variables
			success:function(response){
				if (response.length>0) {
					$('#editmep_'+itemId).text(response);
				};
				
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
		};
		

	});

	// sql query Get all statuses asc

	$('body').on('click', '#get-all-statuses', function() {
		$('#sql-result').removeClass('hide');

		jQuery.ajax({
		type: "POST", // HTTP method POST or GET
		url: "inc/sql-queries.php", //Where to make Ajax calls
		success:function(response){
			console.log(response);
			$('#sql-result').html(response);
			$(window).scrollTop($('#sql-result').offset().top);
			
		},
		error:function (xhr, ajaxOptions, thrownError){
			//On error, we alert user
			alert(thrownError);
		}
		});
	});
};

$(document).ready(main);