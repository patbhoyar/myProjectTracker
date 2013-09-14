$(function(){

	$(document).on("click", "#submit", function(e){

		e.preventDefault();

        var name = $("#name").val();
		var email = $("#email").val();
        var password = $("#password").val();
		var confirmPassword = $("#confirmPassword").val();

        if (password != confirmPassword){
            alert("Passwords must Match");
            return false;
        }

		$.post(
            'config/ajaxServer.php',
            {
                "request"           :   "createUser",
                "name"              :   name,
                "email"             :   email,
                "password"          :   password,
                "confirmPassword"	: 	confirmPassword
            },
            function(data){
                var obj = $.parseJSON(data);
                
                if (obj.code == "500") {
                    alert(obj.message)
                }else{
                    console.log(obj.message);
                }

        });

	});

});