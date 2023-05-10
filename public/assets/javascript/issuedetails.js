let popup = document.getElementById('responded-issues-popup');
let response = document.getElementById('response');

function openPopup(){
    popup.classList.add("open-popup");

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/issue/getRespondedIssues', true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closePopup(){
    popup.classList.remove("open-popup");
}

function getIssueInfo(id){
    document.getElementById('issues-info-popup').classList.add("open-popup");
    document.getElementById('issue-id').innerHTML = id;

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/issue/getPendingIssueDetails/' + id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                document.getElementById('issue-details').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function closeIssueInfoPopup()
{
    document.getElementById('issues-info-popup').classList.remove("open-popup");
}

function displayImage(id)
{
    document.getElementById(id).classList.add("open-image-popup");
}

function closeImage(id)
{
    document.getElementById(id).classList.remove("open-image-popup");
}

function saveResponse(id)
{
    let response = document.getElementById('response').value;

    if(response === "")
    {
        document.getElementById('response-error').innerHTML = "&nbsp *Response cannot be empty";
    }else if(response.length > 1024)
    {
        document.getElementById('response-error').innerHTML = "&nbsp *Response cannot be more than 1024 characters";
    }else {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/WoodWorks/public/issue/saveResponse', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.response)
                    if(xhr.response === 'success'){
                        response.innerHTML = "<div class='cat-success'>\n" +
                            "        <h2>Response Saved Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                }
            }
        }
        xhr.send('id=' + id + '&response=' + response);
    }
}