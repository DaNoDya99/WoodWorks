let doc_id = '';

function openDocumentPopups(id,event) {
    event.preventDefault();

    let popup = document.getElementById("popups");
    popup.style.visibility = "visible";
    var header = document.getElementById("order_id");
    header.innerHTML = id;
    doc_id = id;

    $.ajax({
        url: 'http://localhost/WoodWorks/public/driver_home/details/' + doc_id,
        dataType: 'json',
        success: function(data) {
            console.log(data[0].ProductID);

            var tbody = document.querySelector(".details-table tbody");
            tbody.innerHTML = "";

            for (var i = 0; i < data.length; i++) {
                var name = data[i].Name;
                var cost = data[i].Cost;
                var image = data[i].Image;
                var quantity = data[i].Quantity;
                var pid = data[i].ProductID;

                var row = document.createElement("tr");
                var nameCell = document.createElement("td");
                var quantityCell = document.createElement("td");
                var costCell = document.createElement("td");
                var imageCell = document.createElement("td");

                if (image == '' || name == null || cost == null || quantity == null) {
                    nameCell.textContent = "No Data";
                    quantityCell.textContent = "No Data";
                    costCell.textContent = "No Data";
                    imageCell.innerHTML = '<img src="http://localhost/WoodWorks/public/assets/images/driver/No_image.jpg" alt="No Image">';
                } else {
                    nameCell.textContent = name;
                    quantityCell.textContent = quantity;
                    costCell.textContent = "Rs. " + cost + ".00";
                    if (image != null) {
                        imageCell.innerHTML = '<img src="http://localhost/WoodWorks/public/' + image + '" alt="' + name + '">';
                    }
                }

                row.appendChild(nameCell);
                row.appendChild(quantityCell);
                row.appendChild(costCell);
                row.appendChild(imageCell);
                tbody.appendChild(row);

                console.log('ProductName: ' + name + ', Cost: ' + cost + ', Quantity: ' + quantity + ', Image: ' + image);
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







