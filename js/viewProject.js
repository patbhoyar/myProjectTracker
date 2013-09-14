var pid = "", project = "", clientName = "", projectStatus = "", projectType = "", projectTasks = "";

function displayProject(){

    //console.log(project);

    var projectName         	= project.projectName;
    var clientName           	= project.clientName;
    var projectType            	= project.projectType;
    var projectStartDate        = project.projectStartDate;
    var projectEndDate  		= project.projectEndDate;
    var projectEstimatedHours   = project.projectEstimatedHours;
    var projectStatus          	= project.projectStatus;
    var projectBudget 			= project.projectBudget;
    var projectNotes           	= project.projectNotes;

    $("#heading").text(projectName);
    $("#projectClientContainer").find("div.itemData").text(clientName);
    $("#projectTypeContainer").find("div.itemData").text(projectType);
    $("#projectStartDateContainer").find("div.itemData").text(projectStartDate);
    $("#projectEndDateContainer").find("div.itemData").text(projectEndDate);
    $("#projectEstimatedHoursContainer").find("div.itemData").text(projectEstimatedHours);
    $("#projectStatusContainer").find("div.itemData").text(projectStatus);
    $("#projectBudgetContainer").find("div.itemData").text(projectBudget);
    $("#projectNotesContainer").find("div.itemData").text(projectNotes);
    $("#editProjectContainer").find("div.itemText").html("<div id='editProject' class='button'> Edit Project </div>");
    $("#editProjectContainer").find("div.itemData").html("<div id='addTask' class='button' data-pid='"+pid+"'> Add Task </div>");
}

function displayEditProject(){

    var projectName             = project.projectName;
    clientName                  = project.clientName;
    projectType                 = project.projectType;
    var projectStartDate        = project.projectStartDate;
    var projectEndDate          = project.projectEndDate;
    var projectEstimatedHours   = project.projectEstimatedHours;
    projectStatus               = project.projectStatus;
    var projectBudget           = project.projectBudget;
    var projectNotes            = project.projectNotes;

    $("#heading").html("<input type='text' id='projectName' value='"+projectName+"'>");
    $("#projectClientContainer").find("div.itemData").text(clientName);
    $("#projectTypeContainer").find("div.itemData").text(projectType);
    $("#projectStartDateContainer").find("div.itemData").html("<input type='text' id='startDatePicker' value='"+projectStartDate+"'>");
    $("#projectEndDateContainer").find("div.itemData").html("<input type='text' id='endDatePicker' value='"+projectEndDate+"'>");
    $("#projectEstimatedHoursContainer").find("div.itemData").html("<input type='text' id='projectEstimatedHours' value='"+projectEstimatedHours+"'>");
    $("#projectStatusContainer").find("div.itemData").text(projectStatus);
    $("#projectBudgetContainer").find("div.itemData").html("<input type='text' id='projectBudget' value='"+projectBudget+"'>");
    $("#projectNotesContainer").find("div.itemData").html("<textarea name='projectNotes' id='projectNotes' cols='30' rows='10'>"+projectNotes+"</textarea>");
    $("#editProjectContainer").find("div.itemText").html("<div id='saveChanges' class='button'> Save Changes </div>");
    $("#editProjectContainer").find("div.itemData").html("<div id='cancelChanges' class='button'> Cancel </div>");
}

function displayEditProjectTypeOptions(){

    if (projectTypeOptions == "") 
        getProjectTypeOptions();

    var data = projectTypeOptions;

    var length = data.length, theProjectTypeOptions = "<select name='projectTypeOptionsList' id='projectTypeOptionsList'><option value='0'>select project type</option>";
    for (var i = 0; i < length; i++) {
        if (projectType == data[i].projectType)
            theProjectTypeOptions += "<option value='"+data[i].id+"' selected>"+data[i].projectType+"</option>"; 
        else
            theProjectTypeOptions += "<option value='"+data[i].id+"'>"+data[i].projectType+"</option>"; 
    }
    theProjectTypeOptions += "</select>"; 
    $("#projectTypeContainer").find("div.itemData").html(theProjectTypeOptions);
}

function displayEditProjectStatusOptions(){

    if (projectStatusOptions == "") 
        getProjectStatusOptions();

    var data = projectStatusOptions;
    var length = data.length, statusOptions = "<select name='projectStatus' id='projectStatus'><option value='0'>select status</option>";
    for (var i = 0; i < length; i++) {
        if (projectStatus == data[i].status)
            statusOptions += "<option value='"+data[i].id+"' selected>"+data[i].status+"</option>"; 
        else
            statusOptions += "<option value='"+data[i].id+"'>"+data[i].status+"</option>";
    }
    statusOptions += "</select>";
    $("#projectStatusContainer").find("div.itemData").html(statusOptions);
}

function displayEditProjectClients(){

    if (allClients == "") 
        getAllClients();

    var data = $.parseJSON(allClients);
    var length = data.length, clients = "<select name='clientsList' id='clientsList'><option value='0'>select client</option>";
    for (var i = 0; i < length; i++) {
        if (clientName == data[i].name) 
            clients += "<option value='"+data[i].id+"' selected>"+data[i].name+"</option>"; 
        else
            clients += "<option value='"+data[i].id+"'>"+data[i].name+"</option>"; 
    }
    clients += "</select>"; 
    $("#projectClientContainer").find("div.itemData").html(clients);
}

function displayTasksForProject(){
    
    var tasks = projectTasks;
    if (tasks.code != 100) {
        $("#noTasks").css("display", "block");
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

    $(document).on("click", ".row", function(){
        window.location = "viewTask.php?tid="+$(this).data("id");
    });
}

function callback(theVar, data){
    switch(theVar){
        case "project":
            project = $.parseJSON(data);
            displayProject();
            break;
        case "getProjectTypeOptions":
            projectTypeOptions = data;
            displayEditProjectTypeOptions();
            break;
        case "getProjectStatusOptions":
            projectStatusOptions = data;
            displayEditProjectStatusOptions();
            break;
        case "allClients":
            allClients = data;
            displayEditProjectClients();
            break;
        case "tasksForProjectWithId":
            projectTasks = data;
            displayTasksForProject();
            break;
    }
}

function getProject(){
    pid = getURLParam("pid");
     $.post(
        "config/ajaxServer.php",
        {
            "request"   : "getProjectById",
            "pid"       : pid
        },
        function(data){
            data = $.parseJSON(data);
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
            callback("project", data.message); 
        }
    );
}

$(function(){

    onPageLoad();

    function onPageLoad(){
        getProject();
        getTasksForProjectWithId(pid);
    }

    $(document).on("click", "#editProject", function(){
        displayEditProject();
        getAllClients();
        getProjectTypeOptions();
        getProjectStatusOptions();
    });

    $(document).on("click", "#cancelChanges", function(){
        displayProject();
    });

    $(document).on("click", "#saveChanges", function(){
        
        var proj = {};

        proj["pid"]             = pid;
        proj["projName"]        = $("#projectName").val();
        proj["projClient"]      = $("#clientsList").val();
        proj["projType"]        = $("#projectTypeOptionsList").val();
        proj["projStartDate"]   = $("#startDatePicker").val();
        proj["projEndDate"]     = $("#endDatePicker").val();
        proj["projEstHours"]    = $("#projectEstimatedHours").val();
        proj["projStatus"]      = $("#projectStatus").val();
        proj["projBudget"]      = $("#projectBudget").val();
        proj["projNotes"]       = $("#projectNotes").val();

        $.post(
            'config/ajaxServer.php',
            {
                "request"       : "saveEditedProject",
                "proj"          : proj
            },
            function(data){
                
                data = $.parseJSON(data);
                if (data.code == 500) {
                    alert(data.message);
                    return false;
                }else{
                    getProject();
                }
            }
        );


    });

    $(document).on("click", "#addTask", function(){
        window.location="addTask.php?pid="+$(this).data("pid");
    });

    























































});