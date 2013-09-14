var tasks = "", tasksCounter = 0, date = 0;

function displayMyTasks(){

	var taskSelector = "<select class='selectTask'><option value='0'>Select a Task</option>";
	console.log(tasks);
	for (var i = 0; i < tasks.length; i++) {
		taskSelector += "<option value='"+tasks[i].id+"'>"+tasks[i].taskName+"</option>";
	}
	taskSelector += "</select>";

	return taskSelector;
}

function callback(theVar, data){
    switch(theVar){
        case "tasksForCurrentUser":
            tasks = $.parseJSON(data);
            displayMyTasks();
            break;
    }
}

$(function(){

	date = getURLParam("date");
	if (date == 0) { date = Util.getTodaysDate(); }

	$("#today").text(Util.getPrettyDate(date));

	$( "#datepicker" ).datepicker({
      	showOn: "button",
      	buttonImage: "images/calendar.gif",
      	buttonImageOnly: true
    });

	getTasksForCurrentUser();
	getTasksForDate();

	$(document).on("click", "#addLog", function(){

		var taskData = "<div class='newTask taskRow' data-currtaskid='"+tasksCounter+"' id='taskId"+tasksCounter+"'>";
		taskData += "<div class='taskStatus taskItem'> </div>";
		taskData += "<div class='taskPriority taskItem'> </div>";
		taskData += "<div class='taskName taskItem'>"+displayMyTasks()+"</div>";
		taskData += "<div class='taskHours taskItem'> </div>";
		taskData += "<div class='taskNotes taskItem'> </div>";
		taskData += "</div>";

		$("#newTaskContainer").append(taskData);
		tasksCounter++;
	});

	$(document).on("change", ".selectTask", function(){

		var taskId = $(this).val();
		var selectedTask = $(this).parent().parent().data("currtaskid");

		for (var i = 0; i < tasks.length; i++) {
			if (taskId == tasks[i].id) {

				var taskStatuses = "<input type='checkbox' name='newTaskStatus' class='newTaskStatus' id=''/> Completed";

				$("#taskId"+selectedTask).find(".taskStatus").html(taskStatuses);
				$("#taskId"+selectedTask).find(".taskPriority").text(tasks[i].taskPriority);
				$("#taskId"+selectedTask).find(".taskHours").html("<input type='text' class='inputTaskHours'/>");
				$("#taskId"+selectedTask).find(".taskNotes").html("<input type='text' class='inputTaskNotes' value='"+tasks[i].fullTaskNotes+"'/>");

				break;
			}
		}
	});

	$(document).on("click", "#saveLog", function(){

		var jsonObj = [];

		for (var i = 0; i < tasksCounter; i++) {
			var taskStatus = ($("#taskId"+i).find(".newTaskStatus").is(":checked"))?1:0;
			var taskId = $("#taskId"+i).find(".taskName").find(".selectTask").val();
			var taskHrs = $("#taskId"+i).find(".taskHours").find(".inputTaskHours").val();
			var taskNotes = $("#taskId"+i).find(".taskNotes").find(".inputTaskNotes").val();

            var myObject = { "date" : date, "status" : taskStatus, "id" : taskId, "hours" : taskHrs, "notes" : taskNotes };
            jsonObj.push(myObject);

		}

    	var data = { "data" : jsonObj };
    	var jsonData = JSON.stringify(data);

		$.post(
			'config/ajaxServer.php',
			{ request : "saveLog", data : jsonData },
			function(data){
				console.log(data);
		});

	});

	$(document).on("change", "#datepicker", function(){
		window.location = "logHours.php?date="+$(this).val();
	});

	$(document).on("click", "#nextDate", function(){
		window.location = "logHours.php?date="+Util.nextDate(date);
	});

	$(document).on("click", "#prevDate", function(){
		window.location = "logHours.php?date="+Util.prevDate(date);
	});









































































});