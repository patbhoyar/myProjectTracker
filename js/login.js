$(function(){

	$(document).on("click", "#submit", function(e){

		e.preventDefault();

		var email = $("#email").val();
		var password = $("#password").val();

		$.post(
            'config/ajaxServer.php',
            {
                "request"   :   "login",
                "email"		:   email,
                "password"	: 	password
            },
            function(data){
                console.log(data);
                var obj = $.parseJSON(data);
                
                if (obj.code == "500") {
                    alert(obj.message)
                }else{
                    window.location = "index.php";
                }
        });

	});

});