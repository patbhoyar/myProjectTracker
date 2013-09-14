$(document).ready(function(){
	
	$.post(
        'config/ajaxServer.php',
        {
            "request"	:   "getUserInfo"
        },
        function(data){
           var obj = $.parseJSON(data);
            
            if (obj.code == "100") {
            	var userInfo = $.parseJSON(obj.message);
            }
    });

    $(document).on("click", "#logout", function(){
    	$.post(
	        'config/ajaxServer.php',
	        {
	            "request"	:   "logout"
	        },
	        function(data){
	           window.location = "index.php";
	    });
    });

    $(".menuItems").hover(function(){
        $(this).css("background", "#777")
    }, function(){
        $(this).css("background", "#000")
    });

});
