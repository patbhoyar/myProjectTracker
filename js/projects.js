$(function(){

    var allProjects = "", currentSortName = "projName", currentSortOrder = "asc";

    onPageLoad();

    function onPageLoad(){
        getAllProjects();
        displayProjects();
    }

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

    function callback(theVar, data){
        switch(theVar){
            case "allProjects":
                allProjects = $.parseJSON(data);
                allProjects = Util.sortObject("projects", allProjects, "fullProjectName", "string", currentSortOrder);
                break;
        }
    }

    function getProjectIds(){
        if (allProjects == "") 
            getAllProjects();

        var data = $.parseJSON(allProjects);
        var ids = [];
        for (var i = 0; i < data.length; i++) {
            ids.push(data[i].id);
        }
        return ids;
    }

    function displayProjects(){
        //console.log(allProjects);
        $("#projectList").text("");

        var data = allProjects;

        var  projects = "<div class='projRowHeading'>";
            //projects += "<div class='projId projItem'>Id</div>";
            projects += "<div class='projStatus projItem'>Status</div> <div class='projName projItem'>Project Name</div>";
            projects += "<div class='projClient projItem'>Client Name</div> <div class='projType projItem'>Type</div>";
            projects += "<div class='projBudget projItem'>Budget</div> <div class='projStartDate projItem'>Start Date</div>";
            projects += "<div class='projEndDate projItem'>End Date</div> <div class='projEstHours projItem'>Est Hrs</div>";
            projects += "<div class='projNotes projItem'>Notes</div> </div>";

        for (var i = 0; i < data.length; i++) {

            projects += "<div class='projRow' data-pid='"+data[i].id+"'>";
            //projects += "<div class='projId projItem'>"+data[i].id+"</div>";

            switch (data[i].fullProjectStatus){
                case 'Completed':
                    projects += "<div class='projStatus projItem statusGreen' title='"+data[i].fullProjectStatus+"'>"+data[i].shortProjectStatus+"</div>";
                    break;
                case 'In Progress':
                    projects += "<div class='projStatus projItem statusOrange' title='"+data[i].fullProjectStatus+"'>"+data[i].shortProjectStatus+"</div>";
                    break;
                case 'Client Feedback Needed':
                    projects += "<div class='projStatus projItem statusYellow' title='"+data[i].fullProjectStatus+"'>"+data[i].shortProjectStatus+"</div>";
                    break;
                case 'Archived':
                    projects += "<div class='projStatus projItem statusBlue' title='"+data[i].fullProjectStatus+"'>"+data[i].shortProjectStatus+"</div>";
                    break;
            }

            projects += "<div class='projName projItem' title='"+data[i].fullProjectName+"'>"+data[i].shortProjectName+"</div>";
            projects += "<div class='projClient projItem' title='"+data[i].fullClientName+"'>"+data[i].shortClientName+"</div>";
            projects += "<div class='projType projItem' title='"+data[i].fullProjectType+"'>"+data[i].shortProjectType+"</div>";
            projects += "<div class='projBudget projItem'>$"+data[i].projectBudget+"</div>";
            projects += "<div class='projStartDate projItem'>"+data[i].projectStartDate+"</div>";
            projects += "<div class='projEndDate projItem'>"+data[i].projectEndDate+"</div>";
            projects += "<div class='projEstHours projItem'>"+data[i].projectEstimatedHours+"</div>";
            projects += "<div class='projNotes projItem' title='"+data[i].fullProjectNotes+"'>"+data[i].shortProjectNotes+"</div>";
            projects += "</div>";
            
        }

        $("#projectList").html(projects);
    }

    $(document).on("click", ".projRow", function(){
        window.location = "viewProject.php?pid="+$(this).data("pid");
    });

    $(document).on("click", ".projRowHeading>.projName", function(){

        if ((currentSortName == "projName") && (currentSortOrder == "asc"))
            currentSortOrder = "desc";
        else
            currentSortOrder = "asc";

        allProjects = Util.sortObject("projects", allProjects, "fullProjectName", "string", currentSortOrder);
        currentSortName = "projName";
        displayProjects();
    });

    $(document).on("click", ".projRowHeading>.projStatus", function(){

        if ((currentSortName == "projStatus") && (currentSortOrder == "asc"))
            currentSortOrder = "desc";
        else
            currentSortOrder = "asc";

        allProjects = Util.sortObject("projects", allProjects, "fullProjectStatus", "string", currentSortOrder);
        currentSortName = "projStatus";
        displayProjects();
    });

    $(document).on("click", ".projRowHeading>.projType", function(){

        if ((currentSortName == "projType") && (currentSortOrder == "asc"))
            currentSortOrder = "desc";
        else
            currentSortOrder = "asc";

        allProjects = Util.sortObject("projects", allProjects, "fullProjectType", "string", currentSortOrder);
        currentSortName = "projType";
        displayProjects();
    });

    $(document).on("click", ".projRowHeading>.projClient", function(){

        if ((currentSortName == "projClient") && (currentSortOrder == "asc"))
            currentSortOrder = "desc";
        else
            currentSortOrder = "asc";

        allProjects = Util.sortObject("projects", allProjects, "fullClientName", "string", currentSortOrder);
        currentSortName = "projClient";
        displayProjects();
    });

































































});