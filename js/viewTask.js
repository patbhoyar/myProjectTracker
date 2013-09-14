var tid = "", task = "", projects = "", theTaskType = "", taskTypesForProject = "";

function displayTask(){

    //console.log(task);

    var projectName         = task.projectName;
    var taskType            = task.taskType;
    var taskName            = task.taskName;
    var taskAssignee        = task.taskAssignee;
    var taskCompletionDate  = (task.taskCompletionDate == "1970-01-01")?"not set":task.taskCompletionDate;
    var taskDeadline        = task.taskDeadline;
    var taskEstHrs          = task.taskEstHrs;
    var taskHrsToCompletion = task.taskHrsToCompletion;
    var taskApproval        = (task.taskApproval == 1)?"yes":"no";
    var taskStatus          = task.taskStatus;
    var taskPriority        = task.taskPriority;
    var taskNotes           = task.taskNotes;

    $("#heading").text(taskName);
    $("#projectNameContainer").find("div.itemData").text(projectName);
    $("#taskTypeContainer").find("div.itemData").text(taskType);
    $("#taskAssigneeContainer").find("div.itemData").text(taskAssignee);
    $("#taskCompletionDateContainer").find("div.itemData").text(taskCompletionDate);
    $("#taskDeadlineContainer").find("div.itemData").text(taskDeadline);
    $("#taskEstimatedHoursContainer").find("div.itemData").text(taskEstHrs);
    $("#taskHoursToCompletionContainer").find("div.itemData").text(taskHrsToCompletion);
    $("#taskPriorityContainer").find("div.itemData").text(taskPriority);
    $("#taskStatusContainer").find("div.itemData").text(taskStatus);
    $("#taskApprovalContainer").find("div.itemData").text(taskApproval);
    $("#taskNotesContainer").find("div.itemData").text(taskNotes);
    $("#editTaskContainer").find("div.itemText").html("<div id='editTask' class='button'> Edit Task </div>");
    $("#editTaskContainer").find("div.itemData").html("");
}

function displayEditTask(){

    var projectName         = task.projectName;
    var taskType            = task.taskType;
    var taskName            = task.taskName;
    var taskAssignee        = task.taskAssignee;
    var taskCompletionDate  = task.taskCompletionDate;
    var taskDeadline        = task.taskDeadline;
    var taskEstHrs          = task.taskEstHrs;
    var taskHrsToCompletion = task.taskHrsToCompletion;
    var taskApproval        = (task.taskApproval == 1)?"yes":"no";
    var taskStatus          = task.taskStatus;
    var taskPriority        = task.taskPriority;
    var taskNotes           = task.taskNotes;

    $("#heading").html("<input type='text' id='taskName' value='"+taskName+"'>");
    $("#taskCompletionDateContainer").find("div.itemData").html("<input type='text' id='taskCompletionDatePicker' value='"+taskCompletionDate+"'>");
    $("#taskDeadlineContainer").find("div.itemData").html("<input type='text' id='taskDeadlineDatePicker' value='"+taskDeadline+"'>");
    $("#taskEstimatedHoursContainer").find("div.itemData").html("<input type='text' id='taskEstimatedHours' value='"+taskEstHrs+"'>");
    $("#taskHoursToCompletionContainer").find("div.itemData").html("<input type='text' id='taskHoursToCompletion' value='"+taskHrsToCompletion+"'>");
    $("#taskNotesContainer").find("div.itemData").html("<textarea name='taskNotes' id='taskNotes' cols='30' rows='10'>"+taskNotes+"</textarea>");
    $("#editTaskContainer").find("div.itemText").html("<div id='saveChanges' class='button'> Save Changes </div>");
    $("#editTaskContainer").find("div.itemData").html("<div id='cancelChanges' class='button'> Cancel </div>");

    $("#taskDeadlineDatePicker").datepicker();
    $("#taskCompletionDatePicker").datepicker();
}

function getTask(){
    tid = getURLParam("tid");
     $.post(
        "config/ajaxServer.php",
        {
            "request"   : "getTaskById",
            "tid"       : tid
        },
        function(data){
            data = $.parseJSON(data);
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
            callback("task", data.message); 
        }
    );
}

function displayProjects(){
    //console.log(projects);
    var projs = projects;
    projects = $.parseJSON(projects), projectList = "<select name='projectName' id='projectName'><option value='0'>select a project</option>";
    for (var i = 0; i < projs.length; i++) {
        if (task.projectName == projs[i].fullProjectName){
            projectList += "<option value='"+projs[i].id+"' selected>"+projs[i].fullProjectName+"</option>";
            getTaskTypesForProjectWithId(projs[i].id);
        }
        else
            projectList += "<option value='"+projs[i].id+"'>"+projs[i].fullProjectName+"</option>";
    }
    projectList += "</select>";
    $("#projectNameContainer").find("div.itemData").html(projectList);
}

function displayTaskTypesForProject(){
    console.log(taskTypes);
    var theTaskTypes = $.parseJSON(taskTypes);
    var taskTypesList = "<select name='taskType' id='taskType'><option value='0'>select a Task Type</option>";
    for (var i = 0; i < theTaskTypes.length; i++) {
        if (task.taskType == theTaskTypes[i].taskType)
            taskTypesList += "<option value='"+theTaskTypes[i].id+"' selected>"+theTaskTypes[i].taskType+"</option>";
        else
            taskTypesList += "<option value='"+theTaskTypes[i].id+"'>"+theTaskTypes[i].taskType+"</option>";
    }
    taskTypesList += "</select>";
    $("#taskTypeContainer").find("div.itemData").html(taskTypesList);
}

function displayUsers(){

    var usr = taskAssignees;
    var users = $.parseJSON(taskAssignees);
    var userList = "<select name='users' id='users'><option value='0'>select a user</option>";
    for (var i = 0; i < usr.length; i++) {
        if (task.taskAssignee == usr[i].name) 
            userList += "<option value='"+usr[i].id+"' selected>"+usr[i].name+"</option>";
        else
            userList += "<option value='"+usr[i].id+"'>"+usr[i].name+"</option>";
    }
    userList += "</select>";
    $("#taskAssigneeContainer").find("div.itemData").html(userList);
}

function displayTaskPriorities(){

    var prio = taskPriorities;
    var priorities = $.parseJSON(taskPriorities);
    var prioritiesList = "<select name='taskPriority' id='taskPriority'><option value='0'>select task priority</option>";
    for (var i = 0; i < prio.length; i++) {
        if (task.taskPriority == prio[i].priorityName) 
            prioritiesList += "<option value='"+prio[i].id+"' selected>"+prio[i].priorityName+"</option>";
        else
            prioritiesList += "<option value='"+prio[i].id+"'>"+prio[i].priorityName+"</option>";
    }
    prioritiesList += "</select>";
    $("#taskPriorityContainer").find("div.itemData").html(prioritiesList);
}

function displayTaskStatusOptions(){
    var statusList = "<select name='taskStatus' id='taskStatus'><option value='0'>select a status</option>";
    for (var i = 0; i < taskStatusOptions.length; i++) {
        if (task.taskStatus == taskStatusOptions[i].status) 
            statusList += "<option value='"+taskStatusOptions[i].id+"' selected>"+taskStatusOptions[i].status+"</option>";
        else
            statusList += "<option value='"+taskStatusOptions[i].id+"'>"+taskStatusOptions[i].status+"</option>";
    }
    statusList += "</select>";
    $("#taskStatusContainer").find("div.itemData").html(statusList);
}

function displayApproval(){

    var approvalList = "<select name='approvals' id='approvals'><option value='-1'>is task approved?</option>";
    if (task.taskApproval == "yes")
        approvalList += "<option value='1' selected>yes</option><option value='0'>no</option></select>";
    else
        approvalList += "<option value='1'>yes</option><option value='0' selected>no</option></select>";

    $("#taskApprovalContainer").find("div.itemData").html(approvalList);
}

function callback(theVar, data){
    switch(theVar){
        case "task":
            task = $.parseJSON(data);
            displayTask();
            break;
        case "allProjects":
            projects = $.parseJSON(data);
            displayProjects();
            break;
        case "taskAssignees":
            taskAssignees = $.parseJSON(data);
            displayUsers();
            break;
        case "taskPriorities":
            taskPriorities = $.parseJSON(data);
            displayTaskPriorities();
            break;
        case "taskStatusOptions":
            taskStatusOptions = data;
            displayTaskStatusOptions();
            break;
        case "taskTypesForProject":
            taskTypes = data;
            displayTaskTypesForProject();
            break;
    }
}

$(function(){

    onPageLoad();

    function onPageLoad(){
        getTask();
    }


    $(document).on("click", "#editTask", function(){
        displayEditTask();
        getAllProjects();
        getTaskAssignees();
        getTaskPriorities();
        getTaskStatusOptions();
        displayApproval();
    });

    $(document).on("click", "#cancelChanges", function(){
        displayTask();
    });

    $(document).on("click", "#saveChanges", function(){
        
        var task = {};

        task["tid"]                 = tid;
        task["taskName"]            = $("#taskName").val(); 
        task["projectName"]         = $("#projectName").val(); 
        task["taskType"]            = $("#taskType").val(); 
        task["taskAssignee"]        = $("#users").val(); 
        task["taskCompletionDate"]  = $("#taskCompletionDatePicker").val(); 
        task["taskDeadline"]        = $("#taskDeadlineDatePicker").val(); 
        task["taskEstHrs"]          = $("#taskEstimatedHours").val(); 
        task["taskHrsToCompletion"] = $("#taskHoursToCompletion").val(); 
        task["taskPriority"]        = $("#taskPriority").val(); 
        task["taskStatus"]          = $("#taskStatus").val(); 
        task["taskApproval"]        = $("#approvals").val(); 
        task["taskNotes"]           = $("#taskNotes").val(); 

        console.log(task);

        $.post(
            'config/ajaxServer.php',
            {
                "request"       : "saveEditedTask",
                "task"          : task
            },
            function(data){
                
                data = $.parseJSON(data);
                if (data.code == 500) {
                    alert(data.message);
                    return false;
                }else{
                    getTask();
                }
            }
        );


    });


























































});