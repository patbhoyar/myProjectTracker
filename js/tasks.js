$(function(){

	$.post(
		'config/ajaxServer.php',
		{ "request" : "getAllTasks" },
		function (data){

			var tasks = $.parseJSON(data);

			if (tasks.code != 100) {
				alert(tasks.message);
				return false;
			}

			tasks = $.parseJSON(tasks.message);
			var taskData = "<div id='header'><div class='taskStatus'>Status</div><div class='taskPriority'>Priority</div><div class='taskDeadline'>Deadline</div>";
			taskData += "<div class='taskName'>Task Name</div><div class='taskNotes'>Notes</div></div>";	

			for (var i = 0; i < tasks.length; i++) {

				var statusColor = "";
				switch(tasks[i].taskStatus){
					case "Assigned":
						statusColor = "statusYellow";
						break;
					case "In Progress":
						statusColor = "statusOrange";
						break;
					case "Completed":
						statusColor = "statusGreen";
						break;
					case "Archived":
						statusColor = "statusBlue";
						break;
				}

				taskData += "<div class='row' data-id='"+tasks[i].id+"'><div class='taskStatus "+statusColor+"'>"+tasks[i].taskStatus+"</div>";
				taskData += "<div class='taskPriority'>"+tasks[i].taskPriority+"</div><div class='taskDeadline'>"+tasks[i].taskDeadline;
				taskData += "</div><div class='taskName'>"+tasks[i].taskName+"</div>";
				if(tasks[i].shortTaskNotes == "")
					taskData += "<div class='taskNotes emptyNotes'>No Notes</div></div>";
				else
				taskData += "<div class='taskNotes' title='"+tasks[i].fullTaskNotes+"'> "+tasks[i].shortTaskNotes+" </div></div>";
			};

			$("#taskList").html(taskData);
		}
	);

	$(document).on("click", ".row", function(){
		window.location = "viewTask.php?tid="+$(this).data("id");
	});

});