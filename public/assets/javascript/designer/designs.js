function load_image(file)
{
    for (var i = 0; i <=file.length - 1; i++)
    {
        document.querySelector(".js-filename").innerHTML = document.querySelector(".js-filename").innerHTML +" "+file.item(i).name;

        var mylink = window.URL.createObjectURL(file.item(i));

        document.querySelector(".js-image-preview").src = mylink;
    }
    // "Selected Files: " +
    // // GET THE FILE INPUT.
    // var fi = document.getElementById('file');
    //
    // // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
    // if (fi.files.length > 0) {
    //
    //     // THE TOTAL FILE COUNT.
    //     document.getElementById('fp').innerHTML =
    //         'Total Files: <b>' + fi.files.length + '</b></br >';
    //
    //     // RUN A LOOP TO CHECK EACH SELECTED FILE.
    //     for (var i = 0; i <= fi.files.length - 1; i++) {
    //
    //         var fname = fi.files.item(i).name;      // THE NAME OF THE FILE.
    //         var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
    //
    //         // SHOW THE EXTRACTED DETAILS OF THE FILE.
    //         document.getElementById('fp').innerHTML =
    //             document.getElementById('fp').innerHTML + '<br /> ' +
    //             fname + ' (<b>' + fsize + '</b> bytes)';
    //     }
    // }
    // else {
    //     alert('Please select a file.')
    // }

}