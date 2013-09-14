$(function(){

    var allClients = "", projectStatusOptions = "", projectTypeOptions = "";

    onPageLoad();

    function onPageLoad(){
        getProjectStatusOptions();
        getProjectTypeOptions();
        getAllClients();
        displayProjectStatusOptions();
        displayProjectTypeOptions();
        displayClients();
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

    function callback(theVar, data){
        switch(theVar){
            case "getProjectStatusOptions":
                projectStatusOptions = data;
                break;
            case "allClients":
                allClients = data;
                break;
            case "getProjectTypeOptions":
                projectTypeOptions = data;
                break;
        }
    }

    function displayProjectStatusOptions(){

        if (projectStatusOptions == "") 
            getProjectStatusOptions();

        data = projectStatusOptions;
        var length = data.length, statusOptions = "<select name='projectStatus' id='projectStatus'><option value='0'>select status</option>";
        for (var i = 0; i < length; i++) {
            statusOptions += "<option value='"+data[i].id+"'>"+data[i].status+"</option>";
        }
        statusOptions += "</select>";
        $("#projectStatusContainer").find("div.itemData").html(statusOptions);
    }

    function displayClients(){

        var cid = 0;
        if (getURLParam("cid") != 0)
            cid = getURLParam("cid");

        if (allClients == "") 
            getAllClients();

        var data = $.parseJSON(allClients);
        var length = data.length, clients = "<select name='clientsList' id='clientsList'><option value='0'>select client</option>";
        for (var i = 0; i < length; i++) {
            if (cid == data[i].id)
                clients += "<option value='"+data[i].id+"' selected>"+data[i].name+"</option>";
            else 
                clients += "<option value='"+data[i].id+"'>"+data[i].name+"</option>"; 
        }
        clients += "</select>"; 
        $("#projectClientContainer").find("div.itemData").html(clients);
    }

    function displayProjectTypeOptions(){

        if (projectTypeOptions == "") 
            getProjectTypeOptions();

        var data = projectTypeOptions;

        var length = data.length, theProjectTypeOptions = "<select name='projectTypeOptionsList' id='projectTypeOptionsList'><option value='0'>select project type</option>";
        for (var i = 0; i < length; i++) {
            theProjectTypeOptions += "<option value='"+data[i].id+"'>"+data[i].projectType+"</option>"; 
        }
        theProjectTypeOptions += "</select>"; 
        $("#projectTypeContainer").find("div.itemData").html(theProjectTypeOptions);
    }


    $("#startDatePicker").datepicker();
    $("#endDatePicker").datepicker();

    $(document).on("click", "#addProject", function(){

        var proj = {};
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
                "request"       : "addProject",
                "proj"          : proj
            },
            function(data){
                
                data = $.parseJSON(data);
                if (data.code == 500) {
                    alert(data.message);
                    return false;
                }else{
                    alert("Project Successfully Added");
                    window.location = "projects.php";
                }
            }
        );

    });




























































});