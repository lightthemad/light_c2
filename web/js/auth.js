$(document).ready(function()
{
    function auth()
    {
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();

        if( username != "" && password != "" )
        {
            $("#error").html(" ");
            $.ajax({
                url:'/login',
                type:'post',
                data:{username:username,password:password},
                success:function(response)
                {
                    var msg = "";
                    if(response == 1)
                    {
                        window.location = "/";
                    }

                    else if (response == 2)
                    {
                        $("#error").html("Invalid username or password");
                    }

                    else if (response == 3)
                    {
                        $("#error").html("Looks like there is no table in your database detected!");
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

    $("#auth").click(function()
    {
        auth();
    });

    document.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            auth();
        }
    });
});