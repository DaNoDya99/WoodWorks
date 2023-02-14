let cus_chat = document.getElementById("cus-chat");
let chat_btn = document.getElementById("chat-btn");

function openChat(){
    cus_chat.style.visibility = "visible";
    chat_btn.style.visibility = "hidden";
}

function closeChat(){
    cus_chat.style.visibility = "hidden";
    chat_btn.style.visibility = "visible";
}

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

