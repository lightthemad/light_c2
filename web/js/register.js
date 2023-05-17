$(document).ready(function()
{
    function register()
    {
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var role = $("#role").val().trim();

        if( username != "" && password != "")
        {

            $("#error").html(" ");

            
                $("#error").html(" ");
                $.ajax(
                {
                    url:'/register',
                    type:'post',
                    data:{username:username,password:password,role:role},
                    success:function(response)
                    {
                        var msg = "";
                        if(response == 1)
                        {
                            window.location = "/users";
                        }
    
                        else if (response == 2)
                        {
                            $("#error").html("This username is already taken!");
                        }

                        else if (response == 3)
                        {
                            $("#error").html("Password must be at least 6 charactes.");
                        }
    
                        else
                        {
                            $("#error").html("Something unexpected happened");
                        }
                    }
                });
         
        }

        else
        {
            msg = "Fields must not be empty!";
            $("#error").html(msg);
        }
    }

    $("#register").click(function()
    {
        register();
    });

});