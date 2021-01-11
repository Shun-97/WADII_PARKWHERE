document.addEventListener("DOMContentLoaded", function () {
    var search = location.search.split('=')[1];
    getCarparkDetails(search);
    image_call() //only for presentation due to limited callback limit
    display_user_add_comment();

});


function getCarparkDetails(search) {
    var star_output = getStars(search);
    var output = "";

    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            var jsObj = JSON.parse(this.responseText);
            // console.log(jsObj);
            var carparkname = jsObj.carparkname;
            var sat_rate = jsObj.sat_rate;
            var wkdy_rate = jsObj.wkdy_rate;
            output += '<header class="py-5 mb-5" style="background: #5ad9f2"><div class="container h-100"><div class="row h-100 align-items-center"><div id="image_output" class="row content flex-justify d-flex justify-content-around"></div><div class="col-lg-12"><p class="display-4 text-white mt-5 mb-2">' + carparkname + '</p>' + star_output + '<p class="lead mb-5 text-dark">Saturday Rates: ' + sat_rate + '</p><p class="lead mb-5 text-dark">Week Day Rates: ' + wkdy_rate + '</p></div></div></div></header>';
        }
    };
    web.open('GET', `php/getspecificcp.php?Carpark=${search}`, false);
    web.send();

    getPosts(search, output)
    // getStars(search, output);
}

function getStars(search, output) { //get rating for this carpark
    const web = new XMLHttpRequest();
    var stars = '';
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            var avgStars = JSON.parse(this.responseText);
            var avgStars = Number(avgStars);
            // console.log(avgStars);
            for (var i = 0; i < Math.round(avgStars); i++) {
                stars += `<span class="fa fa-star checked"></span>`;
            }
            for (var i = Math.round(avgStars); i < 5; i++) {
                stars += `<span class="fa fa-star"></span>`;
            }
            str = `<p>Average Rating: ${stars}(${avgStars})</p>`;
        }
    };

    web.open('GET', `php/getavgstars.php?Carpark=${search}`, false);
    web.send();
    return str;
}

function getPosts(search, output) {
    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            var jsObjs = JSON.parse(this.responseText);
            // console.log(jsObj);
            output += '<div class="display-4 col-md-10 col-xd-10 mx-auto ">View other comments (' + jsObjs.length + ')</div>';
            if (jsObjs) {
                for (jsObj of jsObjs) {
                    var username = jsObj.username;
                    var info = jsObj.info;
                    var stars = jsObj.stars;
                    var prtStars = Number(stars);
                    var pstars = "";
                    for (var i = 0; i < prtStars; i++) {
                        pstars += `<span class="fa fa-star checked"></span>`;
                    }
                    for (var i = prtStars; i < 5; i++) {
                        pstars += `<span class="fa fa-star"></span>`;
                    }
                    // console.log(pstars);
                    output += `<div class='d-flex col-md-10 col-xs-10 mx-auto review'><div class="wrapper">User: <span class="font-weight-bold">${username}</span><br><div>Rating: ${pstars}</div><br>Reviews: ${info}</div></div>`;
                }
            }
        }
    };
    web.open('GET', `php/getallpost.php?Carpark=${search}`, false);
    web.send();
    display(search, output);
}



function display(output, str) {
    // document.getElementById("display").innerHTML = output;
    document.getElementsByClassName("container-fluid")[0].innerHTML = str;
    // for (var i = 0; i < 3; i++) {
    //     document.getElementById("image_output").innerHTML += "<img class='col-md-3 img-fluid' src='images/poorteam.jpg'>"
    // }
}

function display_user_add_comment() { //only show for logged in users
    var user_role = document.getElementById("isUser").innerText;
    if (user_role != "Guest") {
        let rating = 4;
        var stars = '';
        for (let i = 1; i < 6; i++) {
            if (i <= rating) {
                stars += '<span class="rating fa fa-star checked"></span>'
            } else {
                stars += '<span class="rating fa fa-star"></span>'
            }
        }

        document.getElementsByClassName("container-fluid")[0].innerHTML += `<div class='col-md-10 col-xs-10 mx-auto' id='user-comment-box'>
            <p class="display-4">Leave a review</p>
            <form action="php/update_review.php" method="get" class="mb-4">
                <input type="hidden" name="cp" id="cp" value="">
                <div id='rating_output' class="rating-group">
                    <input class="rating__input rating__input--none" name="rating" id="rating-none" value="0" type="radio" checked>
                    <label aria-label="1 star" class="rating__label" for="rating-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                    <label aria-label="2 stars" class="rating__label" for="rating-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                    <label aria-label="3 stars" class="rating__label" for="rating-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating-3" value="3" type="radio">
                    <label aria-label="4 stars" class="rating__label" for="rating-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                    <label aria-label="5 stars" class="rating__label" for="rating-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating-5" value="5" type="radio">
                </div>

                <div class="form-group justify-content-center">
                    <label for="info">Your Review</label>
                    <textarea class="form-control" id="info" rows="3" placeholder="e.g. Bad network connection inside, lights not working sometimes.." name="info"></textarea>
                </div>
                <!-- <div class='d-flex justify-content-center fo-group'> -->
                <button type="submit" class="btn btn-primary">Submit Review</button>
                <button type="button" class="btn btn-danger">Cancel</button>
                <!-- </div> -->
            </form>
        </div>`;
        document.getElementById('cp').value = location.search.split('=')[1];
        var anchor_ele = document.getElementsByName('rating');
    }
}


function image_call() { //for presentation only~
    var forms = location.search.split('=')[1]; //getting the Carpark from header
    var Carpark_search = forms.replace('%20', ' ');
    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            // console.log(this.responseText)
            jsondata = JSON.parse(this.responseText);
            console.log(jsondata.image_results[0].image_url);
            for (let i = 0; i < 3; i++) {
                document.getElementById('image_output').innerHTML += `<img class='col-md-3' src='${jsondata.image_results[i].image_url}'></img>`
            }
        }

    };
    web.open('GET', `http://api.serpstack.com/search?access_key=e3a0fb80710b60ea7502b893af193fed&query=${Carpark_search}&type=images`, true);
    web.send();
}