let doc_id = '';

function openDocumentPopups(id,event)//name,quantity,cost,image,event
{
    event.preventDefault();

    let popup = document.getElementById("popups");

    popup.style.visibility = "visible";
    doc_id = id;

    $.ajax({
        url: 'http://localhost/WoodWorks/public/driver_home/details/' + doc_id,
        dataType: 'json',
        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                var name = data[i].Name;
                var cost = data[i].Cost;
                var image = data[i].Image;
                var quantity = data[i].Quantity;
                var pid = data[i].ProductID;

                var header1 = document.getElementById('header1_' + pid);
                var header2 = document.getElementById('header2_' + pid);
                var header3 = document.getElementById('header3_' + pid);
                var img = document.getElementById('edit-doc-img_' + pid);

                header1.innerHTML = name;
                header2.innerHTML = quantity;
                header3.innerHTML = "Rs. "+cost+".00";

                if(image != null) {
                    img.setAttribute('src', 'http://localhost/WoodWorks/public/' + image);
                }
                if(image == ''){
                    img.setAttribute('src', 'http://localhost/WoodWorks/public/assets/images/driver/No_image.jpg');
                }

                // Do something with the Cost and Image values, for example:
                console.log('ProductName: ' + name + ', Cost: ' + cost+', Quantity: ' + quantity + ', Image: ' + image);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.error(errorThrown);
        }
    });

}

function closeDocumentPopups()
{
    let popup = document.getElementById("popups");
    popup.style.visibility = "hidden";
}







