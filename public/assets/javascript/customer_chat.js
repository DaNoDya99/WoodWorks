$(document).ready(() => {

    $.ajax(
        {
            type: 'GET',
            url: "http://localhost/WoodWorks/public/Message/getMessages",
            dataType: 'html',
            success: function (data)
            {
                $("#chat").html(
                    data
                )
            }
        }
    )

    $("#button").click( () => {

        const msg = $("#message").val();

        if(msg !== '')
        {
            $.ajax(
                {
                    type: 'POST',
                    url: "http://localhost/WoodWorks/public/Message/sendMsg",
                    data : {message: msg},
                    success: function (data)
                    {

                    }
                }
            )
        }

    });

    setInterval(() => {
        $.ajax({
            type: 'GET',
            url: "http://localhost/WoodWorks/public/Message/getMessages",
            dataType: 'html',
            success: (data) => {
                $("#chat").html(
                    data
                )
            }
        })
    },3000);

});

