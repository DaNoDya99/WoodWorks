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
                    success: (data) => {

                    }
                }
            )
        }
        const chat = $('#chat');
        chat.scrollTo(0,chat.scrollHeight);
        $("#message").val('')
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

        const chat = $('#chat');
        chat.scrollTo(0,chat.scrollHeight);
    },3000);

});

