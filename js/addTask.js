var pid = "";

function displayAllProjects(){

    var projects = $.parseJSON(allProjects), projectList = "<select name='projectName' id='projectName'><option value='0'>select a project</option>";
    
    projects = Util.sortObject("projects", projects, "fullProjectName", "string", "asc");
    //console.log(allProjects);
    for (var i = 0; i < projects.length; i++) {
        if (pid != 0 && pid == projects[i].id) {
            projectList += "<option value='"+projects[i].id+"' selected>"+projects[i].fullProjectName+"</option>";
            onProjectChange(pid);
        }
        else   
            projectList += "<option value='"+projects[i].id+"'>"+projects[i].fullProjectName+"</option>";
    }
    projectList += "</select>";
    $("#projectNameContainer").find("div.itemData").html(projectList);
}

function displayTaskTypes(){

    var theTaskTypes = $.parseJSON(taskTypes);
    var taskTypesList = "<select name='taskType' id='taskType'><option value='0'>select a Task Type</option>";
    for (var i = 0; i < theTaskTypes.length; i++) {
        taskTypesList += "<option value='"+theTaskTypes[i].id+"'>"+theTaskTypes[i].taskType+"</option>";
    }
    taskTypesList += "</select>";
    $("#taskTypeContainer").find("div.itemData").html(taskTypesList);
}

function displayUsers(){

    var users = $.parseJSON(taskAssignees);
    var userList = "<select name='users' id='users'><option value='0'>select a user</option>";
    for (var i = 0; i < users.length; i++) {
        userList += "<option value='"+users[i].id+"'>"+users[i].name+"</option>";
    }
    userList += "</select>";
    $("#taskAssigneeContainer").find("div.itemData").html(userList);
}

function displayTaskPriorities(){

    var priorities = $.parseJSON(taskPriorities);
    var prioritiesList = "<select name='taskPriority' id='taskPriority'><option value='0'>select task priority</option>";
    for (var i = 0; i < priorities.length; i++) {
        prioritiesList += "<option value='"+priorities[i].id+"'>"+priorities[i].priorityName+"</option>";
    }
    prioritiesList += "</select>";
    $("#taskPriorityContainer").find("div.itemData").html(prioritiesList);
}

function displayTaskStatusOptions(){

    var statusList = "<select name='taskStatus' id='taskStatus'>";
    for (var i = 0; i < taskStatusOptions.length; i++) {
        statusList += "<option value='"+taskStatusOptions[i].id+"'>"+taskStatusOptions[i].status+"</option>";
    }
    statusList += "</select>";
    $("#taskStatusContainer").find("div.itemData").html(statusList);
}

function displayApproval(){

    var approvalList = "<select name='approvals' id='approvals'>";
    approvalList += "<option value='0'>no</option><option value='1'>yes</option></select>";
    $("#taskApprovalContainer").find("div.itemData").html(approvalList);
}

function getProjectTypeForProjectWithId(theId){
    
    var projects = $.parseJSON(allProjects);
    for (var i = 0; i < projects.length; i++) {
        if (projects[i].id == theId) {
                console.log("The PID: "+projects[i].fullProjectType);
            for (var j = 0; j < projectTypeOptions.length; j++) {
                console.log(projectTypeOptions[j].projectType);
                if (projectTypeOptions[j].projectType == projects[i].fullProjectType) {
                    return projectTypeOptions[j].id;
                } 
            }
        }
    }
}

function onProjectChange(thePid){
    var projTypeId = getProjectTypeForProjectWithId(thePid);
            console.log(projTypeId);
    getTaskTypes(projTypeId);
}

$(function(){

	onPageLoad();

    function onPageLoad(){
        pid = getURLParam("pid");
        getProjectTypeOptions();
        getAllProjects();
        getTaskStatusOptions();
        getTaskAssignees();
        getTaskPriorities();
        displayApproval();


        for (var j = 0; j < projectTypeOptions.length; j++) 
                console.log(projectTypeOptions[j].projectType);

    }

    $('#projectName').change(function() {
        var thePid = $(this).val();
        onProjectChange(thePid);
    });

    $("#taskDeadlineDatePicker").datepicker();
    $("#taskCompletionDatePicker").datepicker();

    $(document).on("click", "#addTask", function(){

        var task = {};

        task["taskName"] = $("#taskName").val(); 
        task["projectName"] = $("#projectName").val(); 
        task["taskType"] = $("#taskType").val(); 
        task["taskAssignee"] = $("#users").val(); 
        task["taskCompletionDate"] = $("#taskCompletionDatePicker").val(); 
        task["taskDeadline"] = $("#taskDeadlineDatePicker").val(); 
        task["taskEstHrs"] = $("#taskEstimatedHours").val(); 
        task["taskHrsToCompletion"] = $("#taskHoursToCompletion").val(); 
        task["taskPriority"] = $("#taskPriority").val(); 
        task["taskStatus"] = $("#taskStatus").val(); 
        task["taskApproval"] = $("#approvals").val(); 
        task["taskNotes"] = $("#taskNotes").val(); 

        $.post(
            'config/ajaxServer.php',
            {
                "request"   :   "addTask",
                "data"      :   task
            },
            function(data){
                var response = $.parseJSON(data);

                if (response.code != 100) {
                    alert(response.message);
                }else{
                    alert("Task Successfully Added");
                    window.location = "tasks.php";
                }
        });
        
    });























































































});