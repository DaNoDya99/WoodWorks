var refresh = false;


$(document).ready(() => {
    $.ajax({
        type: 'GET',
        url: "http://localhost/WoodWorks/public/Message/getManagerChats",
        dataType: 'html',
        success: (data) => {
            $('#contacts').html(data)
        }
    });

    $('#btn').click(() => {

        const msg = $("#message").val();

        if(msg !== '')
        {
            $.ajax(
                {
                    type: 'POST',
                    url: "http://localhost/WoodWorks/public/Message/sendMsg2",
                    data : {message: msg},
                    success: function (data)
                    {

                    }
                }
            )
        }
    })

});

function load_messages()
{
    $.ajax({
        type: 'GET',
        url: "http://localhost/WoodWorks/public/Message/getMessages2",
        dataType: 'html',
        success: (data) => {
            $('#msgs').html(data)
        }
    });

    refresh = true;
}


    setInterval(() => {
        if(refresh){
            $.ajax({
                type: 'GET',
                url: "http://localhost/WoodWorks/public/Message/getMessages2",
                dataType: 'html',
                success: (data) => {
                    $('#msgs').html(data)
                }
            })
        }
    },3000);
