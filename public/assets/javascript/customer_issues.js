let issue_form = document.getElementById('report-issue');

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