$(document).ready(function()
{
    function create_beacon()
    {
        
        $.ajax({

            url:'/beacon',
            type:'post',
            data:{action:"create"},
            success: function(data)
            {
                location.reload();
            }
        });

    }

    $("#create_beacon").click(function()
    {
        create_beacon();
    });

});

function delete_beacon(beacon_id)
{
    
    $.ajax({

        url:'/beacon',
        type:'post',
        data:{action:"delete",beacon_id:beacon_id},
        success: function(data)
        {
            location.reload();
        }
    });
    
}

function command_beacon(beacon_id)
{
    var command = document.getElementById(beacon_id).value;
    
    $.ajax({

        url:'/beacon',
        type:'post',
        data:{action:"command",beacon_id:beacon_id,command:command},
        success: function(data)
        {
            location.reload();
        }
    });
    
}

setTimeout(function() {
    location.reload();
}, 10000);