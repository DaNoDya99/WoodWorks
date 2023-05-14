let designs_details_popup = document.getElementById('details-info-popup');
let response = document.getElementById('response');
let design_id = '';


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

    xhr.open('GET', 'http://localhost/WoodWorks/public/designer/viewDesignStatus/'+status, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if (xhr.status === 200){
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}
