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

    $('#button').click(() => {

        const msg = $("#message").val();

        if(msg !== '')
        {
            $.ajax(
                {
                    type: 'POST',
                    url: "http://localhost/WoodWorks/public/Message/sendMsg2",
                    data : {message: msg},
                    success: (data) => {

                    }
                }
            )
        }

        $("#message").val('');

    })

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

            $.ajax({
                type: 'GET',
                url: "http://localhost/WoodWorks/public/Message/getManagerChats",
                dataType: 'html',
                success: (data) => {
                    $('#contacts').html(data)
                }
            });
        }

    },2000);

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



