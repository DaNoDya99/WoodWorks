let designs_details_popup = document.getElementById('details-info-popup');

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