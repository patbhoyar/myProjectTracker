$(function(){

    var allClients = "", clientStatusOptions = "";

    onPageLoad();

    function onPageLoad(){
        getClientStatusOptions();
        getAllClients();
        displayClientStatusOptions();
        displayClients();
    }

    function getClientStatusOptions(){
        $.ajax({
            type: 'POST',
            url: 'config/ajaxServer.php',
            data: { "request" : "getClientStatusOptions" },
            success: function(data){
               callback("clientStatusOptions", data); 
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
            case "clientStatusOptions":
                clientStatusOptions = data;
                break;
            case "allClients":
                allClients = data;
                break;
        }
    }

    function getClientIds(){
        if (allClients == "") 
            getAllClients();

        var data = $.parseJSON(allClients);
        var ids = [];
        for (var i = 0; i < data.length; i++) {
            ids.push(data[i].id);
        }
        return ids;
    }

    function displayClientStatusOptions(){

        if (clientStatusOptions == "") 
            getClientStatusOptions();

        data = clientStatusOptions;
        var length = data.length, statusOptions = "<select name='clientStatus' id='clientStatus'>";
        for (var i = 0; i < length; i++) {
            statusOptions += "<option value='"+data[i].id+"'>"+data[i].status+"</option>";
        }
        statusOptions += "</select>";
        $("#clientStatusContainer").html(statusOptions);
    }

    function displayClients(){

        if (allClients == "") 
            getAllClients();

        var data = $.parseJSON(allClients);
        var length = data.length, clients = "";

        for (var i = 0; i < length; i++) {
            clients += "<div id='clientRow"+data[i].id+"' class='clientRow'>";
            clients += "<div class='theClientId'>"+data[i].id+"</div>";

            if (data[i].status == 1) {
                clients += "<div class='theClientStatusIcon iconRed'></div><div class='theClientName'>"+data[i].name+"</div>";
                clients += "<div class='theClientStatus'>INACTIVE</div>";
            }else{
                clients += "<div class='theClientStatusIcon iconGreen'></div><div class='theClientName'>"+data[i].name+"</div>";
                clients += "<div class='theClientStatus'>ACTIVE</div>";
            }
            clients += "</div>";
        }
        $("#clientList").html(clients);

        $("#clientName").val("");
        $("#clientStatus").val(0);
    }

    function displayEditClients(){

        if (allClients == "") 
            getAllClients();

        var data = $.parseJSON(allClients);
        var clientsLength = data.length, clientsData = "";
        
        for (var i = 0; i < clientsLength; i++) {
            clientsData += "<div id='clientRow"+data[i].id+"' class='clientRow'>";
            clientsData += "<div class='theClientId'>"+data[i].id+"</div>";
            clientsData += "<div class='theClientStatusIcon'></div>";
            clientsData += "<div class='theClientName'><input type='text' value='"+data[i].name+"' id='newClientName'/></div>";

            if (clientStatusOptions == "") {
                getClientStatusOptions();
            }

            options = clientStatusOptions;
            var length = options.length, statusOptions = "<select name='newClientStatus' class='newClientStatus'>";
            for (var j = 0; j < length; j++) {
                if (data[i].status == options[j].id) {
                    statusOptions += "<option value='"+options[j].id+"' selected>"+options[j].status+"</option>";
                }else{
                    statusOptions += "<option value='"+options[j].id+"'>"+options[j].status+"</option>";
                }
            }
            statusOptions += "</select>";
            clientsData += "<div class='theClientStatus'>"+statusOptions+"</div>";
            clientsData += "</div>";
        }
        $("#clientList").html(clientsData);
    }

	$(document).on("click", "#addClient", function(){

		var name = $("#clientName").val();
		var status = $("#clientStatus").val();

		$.post(
            'config/ajaxServer.php',
            {
                "request"   :   "addClient",
                "name"		:   name,
                "status"	: 	status
            },
            function(data){
                data = $.parseJSON(data);
                if (data.code == 500) {
                    alert(data.message);
                    return false;
                }else{
                    getAllClients();
                    displayClients();
                }
        });
	});

	$(document).on("click", "#editClients", function(){

        $("#editClients").css("display", "none");
        $("#saveEditedClients, #cancelEditClients").css("display", "block");

        $.post(
            'config/ajaxServer.php',
            { "request"   :   "getAllClients" },
            function(data){
                displayEditClients();
        });
    });

    $(document).on("click", "#saveEditedClients", function(){
        
        var num = getClientIds();
        var jsonObj = "[";

        for (var i = 0; i < num.length; i++) {

            var newName = $("#clientRow"+num[i]).find("#newClientName").val();
            var newStatus = $("#clientRow"+num[i]).find(".newClientStatus").val();

            if (i == (num.length - 1)) {
                jsonObj += '{ "id" : '+num[i]+', "data": { "name": "'+newName+'", "status": '+newStatus+' } }';
            }else{
                jsonObj += '{ "id" : '+num[i]+', "data": { "name": "'+newName+'", "status": '+newStatus+' } },';
            }

        }
        jsonObj += ']';

        $.post(
            'config/ajaxServer.php',
            {
                "request"   :   "saveClients",
                "data"      :   jsonObj
            },
            function(data){
                getAllClients();
                displayClients();
        });

        $("#editClients").css("display", "block");
        $("#saveEditedClients, #cancelEditClients").css("display", "none");

    });

    $(document).on("click", "#cancelEditClients", function(){

        $("#editClients").css("display", "block");
        $("#saveEditedClients, #cancelEditClients").css("display", "none");

        $.post(
            'config/ajaxServer.php', { "request"   :   "getAllClients" },
            function(data){
                displayClients();
        });
    });

    $(document).on("click", ".clientRow", function(){

        var clientId = $(this).find(".theClientId").text();

    });

    $(document).on("click", ".myProjects", function(){
        window.location = "viewProject.php?pid="+$(this).data("pid");
    });

    $(document).on("click", ".addProjectForClient", function(){
        window.location = "addProject.php?cid="+$(this).data("cid");
    });

































































});