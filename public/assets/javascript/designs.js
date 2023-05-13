let designs_details_popup = document.getElementById('details-info-popup');
let response = document.getElementById('response');
let design_id = '';

function downloadPdf(path){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/downloadPdf?filepath='+path, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
            }
        }
    }
    xhr.send();
}



function openDesignDetailsPopup()
{
    designs_details_popup.classList.add('open-popup');
    document.getElementById('accepted').click();
}

function closeDesignDetailsPopup()
{
    designs_details_popup.classList.remove('open-popup');
}

function getDesignsByStatus(status){

    document.querySelectorAll("div[name='selector']").forEach((item) => {
        item.classList.remove('selected');
    })

    document.getElementById(status.toLowerCase()).classList.add('selected');

    let xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/viewDesigns/'+status, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function getDesignInfo(id)
{
    document.getElementById('design-info-popup').classList.add('open-popup');
    document.getElementById('design-id').innerHTML = id;

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/getDesignInfo/'+id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                document.getElementById('design-info').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function changeImage(image){
    document.getElementById('display-image').src = document.getElementById(image).src;
}

function closeDesignInfoPopup()
{
    document.getElementById('design-info-popup').classList.remove('open-popup');
}

function acceptDesign(id)
{
    design_id = id;

    response.innerHTML = "<div class='cat-success'>\n" +
        "        <h2>Do you want to accept the design?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button style='background-color: #17c330' onclick=\"confirmAcceptDesign()\">Yes</button>\n" +
        "            <button style='background-color: #17c330' onclick=\"closeAcceptDesignPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";

}

function rejectDesign(id)
{
    design_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to reject the design?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmRejectDesign()\">Yes</button>\n" +
        "            <button onclick=\"closeRejectDesignPopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";

}

function confirmAcceptDesign()
{
    document.getElementById('response').innerHTML = '';
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/acceptDesign/'+design_id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                document.getElementById('response').innerHTML = xhr.response;
                setTimeout(function () {
                    window.location.reload();
                },1500);
            }
        }
    }
    xhr.send();
}

function closeAcceptDesignPopup()
{
    document.getElementById('response').innerHTML = '';
    design_id = '';
}

function closeRejectDesignPopup()
{
    document.getElementById('response').innerHTML = '';
    design_id = '';
}

function confirmRejectDesign()
{
    document.getElementById('response').innerHTML = '';
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/rejectDesign/'+design_id, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                document.getElementById('response').innerHTML = xhr.response;
                setTimeout(function () {
                    window.location.reload();
                },1500);
            }
        }
    }
    xhr.send();
}