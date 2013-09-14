var allClients = "", projectsForClient = "", currentClient = "", currentCid = "", currentProject = "", currentPid = "", projectTasks = "";

function clearPage(){
	$("#selectProjectContainer").find(".itemData").html("");
	$("#selectProjectContainer").css("display", "none");
	$("#addProjectView").html("").css("display", "none");
	$("#addTaskView").html("").css("display", "none");
	$("#errorView").html("").css("display", "none");
	$("#taskView").html("").css("display", "none");
}

function displayClients(){
	var theClients = "<select name='clientList' id='clientList'><option value='0'>select client</option>";

	for (var i = 0; i < allClients.length; i++) {
		theClients += "<option value='"+allClients[i].id+"'>"+allClients[i].name+"</option>";
	}
	
	theClients += "</select>";
	$("#selectClientContainer").find(".itemData").html(theClients);
}

function displayProjects(){
	
	var addProjectButton = "<a href='addProject.php?cid="+currentCid+"' class='button'>Add Project for "+currentClient+"</a>";    
    $("#addProjectView").html(addProjectButton).css("display", "block");

	if (projectsForClient.code != 100) {
        $("#errorView").text(projectsForClient.message).css("display", "block");
		$("#selectProjectContainer").css("display", "none");
        return false;
    }

	projectsForClient = $.parseJSON(projectsForClient.message);
    projectsForClient = Util.sortString(projectsForClient, "projectName", "asc");
	$("#selectProjectContainer").css("display", "block");

	var theProjects = "<select name='projectList' id='projectList'><option value='0'>select project</option>";

	for (var i = 0; i < projectsForClient.length; i++) {
		theProjects += "<option value='"+projectsForClient[i].id+"'>"+projectsForClient[i].projectName+"</option>";
	}
	
	theProjects += "</select>";
	$("#selectProjectContainer").find(".itemData").html(theProjects).css("display", "block");
}

function displayTasksForProject(){
	
	var addTaskButton = "<a href='addTask.php?pid="+currentPid+"' class='button'>Add Task for "+currentProject+"</a>";    
    $("#addTaskView").html(addTaskButton).css("display", "block");
    
    var tasks = projectTasks;
    if (tasks.code != 100) {
        $("#errorView").text(tasks.message).css("display", "block");
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

    $("#taskView").html(taskData).css("display", "block");

    $(document).on("click", ".row", function(){
        window.location = "viewTask.php?tid="+$(this).data("id");
    });
}

function callback(theVar, data){
    switch(theVar){
        case "allClients":
			allClients = $.parseJSON(data);
            allClients = Util.sortString(allClients, "name", "asc");
            displayClients();
            break;
        case "projectsForClient":
			projectsForClient = data;
            displayProjects();
            break;
        case "tasksForProjectWithId":
			projectTasks = data;
            displayTasksForProject();
            break;
    }
}

$(function(){

	onPageLoad();

    function onPageLoad(){
    	clearPage();
        getAllClients();
    }

    $(document).on("change", "#clientList", function(){
    	clearPage();
    	currentClient = $("#clientList option:selected").text();
        currentCid = $("#clientList").val();
    	getProjectsForClient(currentCid);
    });

    $(document).on("change", "#projectList", function(){
    	currentProject = $("#projectList option:selected").text();
    	currentPid = $("#projectList").val();
    	getTasksForProjectWithId(currentPid);
    });

});