let search_by_category = document.getElementById('search-by-category');
let search_field = document.getElementById('search-field');

search_by_category.onchange = () => {

    let xhr = new XMLHttpRequest();

    xhr.open('GET','http://localhost/WoodWorks/public/furniture/filterPosts/'  + search_by_category.value, true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200){
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

search_field.onkeyup = () => {

    let xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://localhost/WoodWorks/public/furniture/searchPosts/' + search_field.value, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('t-body').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}