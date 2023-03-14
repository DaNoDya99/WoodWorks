function openDocumentPopup(id,event)
{
    event.preventDefault();
    let popup = document.getElementById("edit-sub-cat");
    popup.style.visibility = "visible";
}

function closeDocumentPopup()
{
    let popup = document.getElementById("edit-sub-cat");
    popup.style.visibility = "hidden";
}


