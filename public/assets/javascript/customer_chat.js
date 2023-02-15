let cus_chat = document.getElementById("cus-chat");
let dis_chat = document.getElementById("dis-chat");
let chat_btn = document.getElementById("chat-btn");
let manager = document.getElementById("manager-chat-selector");
let designer = document.getElementById("designer-chat-selector");

function openChat(){
    manager.style.visibility = "visible";
    designer.style.visibility = "visible";
    setTimeout(() => {
        manager.style.visibility = "hidden";
        designer.style.visibility = "hidden";
    },8000);
}

function closeChat(){
    cus_chat.style.visibility = "hidden";
    dis_chat.style.visibility = "hidden";
    chat_btn.style.visibility = "visible";
}

function openManagerChat(){
    cus_chat.style.visibility = "visible";
    manager.style.visibility = "hidden";
    designer.style.visibility = "hidden";
    chat_btn.style.visibility = "hidden";
}

function openDesignerChat(){
    dis_chat.style.visibility = "visible";
    manager.style.visibility = "hidden";
    designer.style.visibility = "hidden";
    chat_btn.style.visibility = "hidden";
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

