function editBio() {
    let value = document.getElementById("bio_text").innerText;

    document.getElementById("bio_text").innerHTML = `
            <form method="POST" action="php/edit_bio.php">
                <textarea id='bio' name = 'bio' required maxlength ='500' style='height:10rem;width:100%'>${value}</textarea>
                <button type="submit">Done</button>
            </form>
        `;
}

function Comment_All() {
    let user = document.getElementById("isUser").innerText;
    let PostOutput = document.getElementById("Post_Output");
    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            jsonobj = JSON.parse(this.responseText);
            // console.log(this.responseText);
            // console.log(jsonobj)
            PostOutput.innerHTML = '';
            for (obj of jsonobj) {
                PostOutput.innerHTML +=`<div class='row m-3' style="border-bottom: 1px solid #e2dfdf;"><div class='row w-100 d-block'><p class='mx-5'>Location: ${obj.carparkname}</p><p class='mx-5 lead'>${obj.info}</p></div></div>`
            }
        }
    };

    web.open('GET', "php/Comment_Pull.php?username="+user, false);
    web.send();
}

function updateBio(){
    var bio = document.getElementById("bio").value;
    console.log(bio);
    document.getElementById("bio_text").innerHTML += ` <input type="hidden" id="rev_bio" name="rev_bio" value="${document.getElementById("bio").value}">`;
}  

