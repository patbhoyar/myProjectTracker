var allProjects = "", taskStatusOptions = "", taskTypes = "", taskAssignees = "", taskPriorities = "", projectTypeOptions = "", projectStatusOptions = "";
var allClients = "";

function getAllProjects(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getAllProjects" },
        success: function(data){

            if (data.code != 100) {
                alert(data.message);
                return false;
            }

            callback("allProjects", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getAllClients(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getAllClients" },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
            callback("allClients", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getTaskStatusOptions(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTaskStatusOptions" },
        success: function(data){
            callback("taskStatusOptions", data); 
        },
        dataType: 'json',
        async:false
    });
}

function getProjectStatusOptions(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getProjectStatusOptions" },
        success: function(data){
           callback("getProjectStatusOptions", data); 
        },
        dataType: 'json',
        async:false
    });
}

function getProjectTypeOptions(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getProjectTypeOptions" },
        success: function(data){
           callback("getProjectTypeOptions", data); 
        },
        dataType: 'json',
        async:false
    });
}

function getTaskTypes(projTypeId){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTaskTypes", "projectType" : projTypeId },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
           callback("taskTypes", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getTaskTypesForProjectWithId(projId){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTaskTypesForProjectWithId", "projId" : projId },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
           callback("taskTypesForProject", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getTaskAssignees(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getAllUsers" },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
           callback("taskAssignees", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getTaskPriorities(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTaskPriorities" },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
           callback("taskPriorities", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getTasksForCurrentUser(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTasksForCurrentUser" },
        success: function(data){
            if (data.code != 100) {
                alert(data.message);
                return false;
            }
           callback("tasksForCurrentUser", data.message); 
        },
        dataType: 'json',
        async:false
    });
}

function getProjectsForClient(cid){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getProjectsForClient", "cid" : cid },
        success: function(data){
           callback("projectsForClient", data); 
        },
        dataType: 'json',
        async:false
    });
}

function getTasksForDate(){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTasksForDate", "date" : date },
        success: function(data){
           callback("projectsForClient", data); 
        },
        dataType: 'json',
        async:false
    });
}

function getTasksForProjectWithId(pid){
    $.ajax({
        type: 'POST',
        url: 'config/ajaxServer.php',
        data: { "request" : "getTasksForProjectWithId", "pid" : pid },
        success: function(data){
           callback("tasksForProjectWithId", data); 
        },
        dataType: 'json',
        async:false
    });
}

function callback(theVar, data){
    switch(theVar){
        case "allProjects":
            allProjects = data;
            displayAllProjects();
            break;
        case "taskStatusOptions":
            taskStatusOptions = data;
            displayTaskStatusOptions();
            break;
        case "getProjectTypeOptions":
            projectTypeOptions = data;
            //displayProjectTypeOptions();
            break;
        case "taskTypes":
            taskTypes = data;
            displayTaskTypes();
            break;
        case "taskAssignees":
            taskAssignees = data;
            displayUsers();
            break;
        case "taskPriorities":
            taskPriorities = data;
            displayTaskPriorities();
            break;
    }
}

    

