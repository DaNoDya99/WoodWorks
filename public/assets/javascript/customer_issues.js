let issue_form = document.getElementById('report-issue');
let response = document.getElementById('response');
let issue_id = '';

issue_form.onsubmit = (e) => {
    e.preventDefault();
}

function load_images(file){
    let i = 0;

    document.querySelectorAll('#issue-images').forEach((img) => {
        img.src = window.URL.createObjectURL(file[i]);
        i++;
    })
}

function reportIssue(id)
{
    let valid = true;

    let formData = new FormData(issue_form);

    if(formData.get('Problem_statement') === ""){
        document.getElementById('problem_statement_error').innerHTML = "&nbsp *Please enter the problem statement";
        valid = false;
    }else if(formData.get('Problem_statement').length > 1024){
        document.getElementById('problem_statement_error').innerHTML = "&nbsp *Problem statement should be less than 1024 characters";
        valid = false;
    }

    if(valid) {

        let xhr = new XMLHttpRequest();

        xhr.open('POST', "http://localhost/WoodWorks/public/issue/addIssue/"+id, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.response);
                    if(xhr.response === "success"){
                        console.log(xhr.response);
                        document.getElementById('response').innerHTML = "<div class='cat-success'>\n" +
                            "        <h2>Issue Reported Successfully.</h2>\n" +
                            "    </div>";

                        setTimeout(() => {
                            location.reload()
                        },2000);

                    }else{
                        document.getElementById('image_error').innerHTML = xhr.response;
                    }
                }
            }
        }
        xhr.send(formData);
    }
}

function getIssues(id)
{
    document.getElementById('issues-info-popup').classList.add('open-popup');

    let xhr = new XMLHttpRequest();
    xhr.open('GET', "http://localhost/WoodWorks/public/issue/getIssuesReportedForTheOrder/"+id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('issues').innerHTML = xhr.response;

                document.querySelectorAll("input[type='radio']")[0].click();
            }
        }
    }
    xhr.send();
}

function closeIssuesPopup()
{
    document.getElementById('issues-info-popup').classList.remove('open-popup');
}

function getIssueDetails(id)
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', "http://localhost/WoodWorks/public/issue/getIssueDetails/"+id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('issue-details').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

function deleteIssue(id)
{
    issue_id = id;

    response.innerHTML = "<div class='cat-success cat-deletion'>\n" +
        "        <h2>Do you want to delete this?</h2>\n" +
        "        <div class=\"cat-deletion-btns\">\n" +
        "            <button onclick=\"confirmDeleteIssue()\">Yes</button>\n" +
        "            <button onclick=\"closeDeleteIssuePopup()\">No</button>\n" +
        "        </div>\n" +
        "    </div>";
}

function closeDeleteIssuePopup()
{
    response.innerHTML = "";
    issue_id = "";
}

function confirmDeleteIssue()
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', "http://localhost/WoodWorks/public/issue/deleteIssue/"+issue_id, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if(xhr.response === "success"){
                    document.getElementById('response').innerHTML = "<div class='cat-success cat-deletion'>\n" +
                        "        <h2>Issue Deleted Successfully.</h2>\n" +
                        "    </div>";

                    setTimeout(() => {
                        location.reload()
                    },2000);
                }
            }
        }
    }
    xhr.send();
}