document.addEventListener("DOMContentLoaded", function () {
    load_script();
    check_if_loggedin();
    attach_login_logout_modals();
    display_back_to_top_button();
    add_login_logout_event_listeners();


});

function add_login_logout_event_listeners() {
    document.getElementById("login-btn").addEventListener("click", function (e) {
        document.getElementById("alert-output").innerHTML = ''
        e.preventDefault();
        var username_input = document.getElementById("username").value;
        var pwd_input = document.getElementById("password").value;
        processLogin(username_input, pwd_input) ? location.reload() : document.getElementById("alert-output").innerHTML += '<div class="alert alert-danger" role="alert">Please enter the correct username and password.</div>';
    });

    document.getElementById("password").addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            console.log("boboboboo");
            e.preventDefault();
            document.getElementById("alert-output").innerHTML = ''
            var username_input = document.getElementById("username").value;
            var pwd_input = document.getElementById("password").value;
            processLogin(username_input, pwd_input) ? location.reload() : document.getElementById("alert-output").innerHTML += '<div class="alert alert-danger" role="alert">Please enter the correct username and password.</div>';
        }
    });


    document.getElementById("logout-btn").addEventListener("click", function (e) {
        e.preventDefault();
        processLogout() ? location.reload() : false;
        // window.location.href = 'php/logout.php';
    });

    document.getElementById("register-btn").addEventListener("click", function (e) {
        e.preventDefault();
        let username_input = document.getElementById('username_register').value;
        let pwd_input = document.getElementById('password_register').value;
        let cfmpassword_input = document.getElementById('cfmpassword').value;
        let email_input = document.getElementById('email').value;
        var response = processRegister(username_input, pwd_input, cfmpassword_input, email_input);
        if (response == "true") { // sucess
            remove_elements("alert");
            document.getElementById("register-btn").outerHTML += '<div class="alert alert-success" role="alert">Registration success! Please login</div>';
            processLogin(username_input, pwd_input) ? location.reload() : false;
        } else {
            var error_response = response;
            var error_array = error_response.split(".");

            remove_elements("alert");
            error_array.forEach((msg) => {
                if (msg == "Please input a valid email") {
                    document.getElementById("input-email").outerHTML += '<div class="alert alert-danger" role="alert">' + msg + '</div>';
                } else if (msg == "Your passwords needs to have a number") {
                    document.getElementById("input-password1").outerHTML += '<div class="alert alert-danger" role="alert">' + msg + '</div>';
                } else if (msg == "Your password needs to be at least 8 letters long") {
                    document.getElementById("input-password1").outerHTML += '<div class="alert alert-danger" role="alert">' + msg + '</div>';
                } else if (msg.includes("already existing")) {
                    document.getElementById("input-username").outerHTML += '<div class="alert alert-danger" role="alert">' + msg + '</div>';
                } else if (msg == "Passwords do not match") {
                    document.getElementById("input-password2").outerHTML += '<div class="alert alert-danger" role="alert">' + msg + '</div>';
                }
            });
        }
    })
}

function remove_elements(className) {
    var no_remove = document.getElementsByClassName(className).length; //no of elements to remove
    if (no_remove > 0) { //there are alert elements
        while (no_remove > 0) {
            document.getElementsByClassName(className)[0].remove();
            no_remove--;
        }
    }
}

function check_if_loggedin() {
    var login_button = '<button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#LoginRegisterModal">Login/Register</button>';
    var logout_button = '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#LogoutModal">Logout</button>';
    var profile_button = '<a href="profile.php"><i class="fas fa-user-circle fa-2x"></i></a>';
    var Register_button = "<button id='registermodal'  class='btn btn-primary' data-toggle='modal' data-target='#RegisterModal'>Sign Up</button>";
    // var user_role = "Guest"; //default

    if (document.getElementById("isUser")) {
        user_role = document.getElementById("isUser").innerText;
    }

    if (user_role == "Guest") {
        loadHeader(login_button);
    } else {
        loadHeader(logout_button, profile_button);
    }
}

function loadHeader(action_button, profile_btn = "") { //init header for every page. do not hardcode headers!!!!!
    var first_element_of_page = document.getElementsByTagName("body")[0];
    var header = document.createElement("nav");

    if (!document.getElementById("search") && !document.getElementById("schedule") && !document.getElementById("index")) { // if not search page, use dark headers
        header.setAttribute("class", "navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-4");
    } else { // if is search page or schedule, use transparent headers
        header.setAttribute("class", "navbar navbar-expand-lg fixed-top p-4");
    }

    if (document.getElementById("index")) {
        header.innerHTML += "<a class='navbar-brand' href='index.php'><img src='images/logo.png' width='100' height='100' class='d-inline-block align-top' alt=''/><span class='logo1'>Park</span><span class='logo2'>Where?</span></a><button class='navbar-toggler mt-1' type='button' data-toggle='collapse' data-target='#navbarCollapse'><i class='fas fa-bars'></i></button><div class='collapse navbar-collapse' id='navbarCollapse'><ul class='navbar-nav flex-column flex-md-row flex-column-reverse w-100'><li class='nav-item'>" + action_button + "</li><li class='nav-item'><a href='#about'>Features<span class='text-white'></span></a></li><li class='nav-item'><a href='#abt-us'><span class='text-white'>Our Mission</span></a></li><li class='nav-item'><a href='#action'><span class='text-white'>Let's Go!</span></a></li></ul>";
    } else if (document.getElementById("search") || document.getElementById("profile") || document.getElementById("maps") || document.getElementById("addcarpark_user")) {
        header.innerHTML += "<a class='navbar-brand' href='search.php'><img src='images/logo.png' width='100' height='100' class='d-inline-block align-top' alt=''/><span class='logo1'>Park</span><span class='logo2'>Where?</span></a><button class='navbar-toggler mt-1' type='button' data-toggle='collapse' data-target='#navbarCollapse' style='border: 2px solid #adadad;'><i class='fas fa-bars'></i></button><div class='collapse navbar-collapse' id='navbarCollapse'><ul class='navbar-nav flex-column flex-md-row flex-column-reverse w-100'><li class='nav-item'>" + action_button + "</li><li class='nav-item'><a href='schedule.php'><span class='text-white'>Schedule a Trip</span></a></li><li class='nav-item' style='margin-right:10%'><a href='maps.php'><span class='text-white'>View Nearby Carparks</span></a></li><li class='nav-item' style='margin-right:10%'>" + profile_btn + "</li></ul></div>";
    } else if (document.getElementById("schedule")) {
        header.innerHTML += "<a class='navbar-brand' href='search.php'><img src='images/logo.png' width='100' height='100' class='d-inline-block align-top' alt=''/><span class='logo1'>Park</span><span class='logo2'>Where?</span></a><button class='navbar-toggler mt-1' type='button' data-toggle='collapse' data-target='#navbarCollapse'><i class='fas fa-bars'></i></button><div class='collapse navbar-collapse' id='navbarCollapse'><ul class='navbar-nav flex-column flex-md-row flex-column-reverse w-100'><li class='nav-item'>" + action_button + "</li><li class='nav-item'><a href='schedule.php'><span class='text-dark mobile-light'>Schedule a Trip</span></a></li><li class='nav-item' style='margin-right:10%'><a href='maps.php'><span class='text-dark  mobile-light'>View Nearby Carparks</span></a></li><li class='nav-item' style='margin-right:10%'>" + profile_btn + "</li></ul></div>";
    } else if (document.getElementById("review")) {
        header.innerHTML += "<a class='navbar-brand' href='search.php'><img src='images/logo.png' width='100' height='100' class='d-inline-block align-top' alt=''/><span class='logo1'>Park</span><span class='logo2'>Where?</span></a><button class='navbar-toggler mt-1' type='button' data-toggle='collapse' data-target='#navbarCollapse'><i class='fas fa-bars'></i></button><div class='collapse navbar-collapse' id='navbarCollapse'><ul class='navbar-nav flex-column flex-md-row flex-column-reverse w-100'><li class='nav-item'>" + action_button + "</li><li class='nav-item'><a href='schedule.php'><span class='text-light mobile-light'>Schedule a Trip</span></a></li><li class='nav-item' style='margin-right:10%'><a href='maps.php'><span class='text-light  mobile-light'>View Nearby Carparks</span></a></li><li class='nav-item' style='margin-right:10%'>" + profile_btn + "</li></ul></div>";
    } else {
        header.innerHTML += "<a class='navbar-brand' href='search.php'><img src='images/logo.png' width='100' height='100' class='d-inline-block align-top' alt=''/><span class='logo1'>Park</span><span class='logo2'>Where?</span></a><button class='navbar-toggler mt-1' type='button' data-toggle='collapse' data-target='#navbarCollapse'><i class='fas fa-bars'></i></button><div class='collapse navbar-collapse' id='navbarCollapse'><ul class='navbar-nav flex-column flex-md-row flex-column-reverse w-100'><li class='nav-item'>" + action_button + "</li><li class='nav-item'><a href='schedule.php'><span class='text-dark'>Schedule a Trip</span></a></li><li class='nav-item' style='margin-right:10%'><a href='maps.php'><span class='text-dark'>View Nearby Carparks</span></a></li><li class='nav-item' style='margin-right:10%'>" + profile_btn + "</li></ul></div>";
    }

    first_element_of_page.prepend(header);
}


function attach_login_logout_modals() {
    var first_element_of_page = document.getElementsByClassName("container-fluid")[0];
    console.log(first_element_of_page);
    first_element_of_page.innerHTML += "<div class='modal fade' id='LoginRegisterModal' tabindex='-1' role='dialog' aria-labelledby='LoginRegisterModal' aria-hidden='true'><div class='modal-dialog modal-dialog-centered' role='document'><div class='modal-content'><label for='username' class='divlabel my-2 '>Username</label><div class='input-group mb-3'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend'><i class='fas fa-user'></i></span></div><input type='text' class='form-control' name='username' id='username' placeholder='Enter your username' aria-describedby='inputGroupPrepend' required></div><label for='password' class='divlabel my-2 '>Password</label><div class='input-group mb-3'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend2'><i class='fas fa-key'></i></span></div><input type='password' class='form-control' name='password' id='password' placeholder='Enter your password' aria-describedby='inputGroupPrepend2' required></div><div><button id='login-btn' input type='submit' class='btn btn-primary'>Log In</button><div id='alert-output'></div></div><a id='registermodal' class='text-info' data-dismiss='modal' data-toggle='modal' data-target='#RegisterModal'>Don't have an account yet? Sign Up here!</a></div></div>";

    first_element_of_page.innerHTML += "<div class='modal fade text-center' id='LogoutModal' tabindex='-1' role='dialog' aria-labelledby='LogoutModal' aria-hidden='true'><div class='modal-dialog modal-dialog-centered' role='document'><div class='modal-content'><h1 class ='my-3'>Are you sure to log out?</h1><div class='row'><div class='col-xs-12 popup-background'><div class='p-5 m-auto'><button id='logout-btn' class='btn btn-primary' href='php/logout.php'>Confirm</button><button class='btn btn-danger' data-dismiss='modal' aria-label='Close'> Cancel </button></div></div></div></div></div></div>";

    first_element_of_page.innerHTML += "<div class='modal fade' id='RegisterModal' tabindex='-1' role='dialog' aria-labelledby='RegisterModal' aria-hidden='true'><div class='modal-dialog modal-dialog-centered' role='document'><div class='modal-content'><form method='POST' action=''><label for='username' class='divlabel my-2'>Username</label><div class='input-group mb-3' id='input-username'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend'><i class='fas fa-user'></i></span></div><input type='text' class='form-control' id='username_register' name='username' placeholder='Enter your username' aria-describedby='inputGroupPrepend' required></div><label for='password' class='divlabel my-2'>Password</label><div class='input-group mb-3' id='input-password1'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend2'><i class='fas fa-key'></i></span></div><input type='password' class='form-control' name='password=' id='password_register' placeholder='Enter your password' aria-describedby='inputGroupPrepend2' required></div><label for='password' class='divlabel my-2 '>Confirm Password</label><div class='input-group mb-3' id='input-password2'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend2'><i class='fas fa-key'></i></span></div><input type='password' class='form-control' name='cfmpassword' id='cfmpassword' placeholder='Enter Password Again' aria-describedby='inputGroupPrepend2' required></div><label for='username' class='divlabel my-2 '>Email Address</label><div class='input-group mb-3' id='input-email'><div class='input-group-prepend'><span class='input-group-text' id='inputGroupPrepend'><i class='fas fa-at'></i></span></div><input type='text' class='form-control' id='email' name='email' placeholder='Enter your email' aria-describedby='inputGroupPrepend' required></div></form><button id='register-btn'  class='btn btn-primary'>Sign Up</button><a data-dismiss='modal' data-toggle='modal' data-target='#LoginRegisterModal' class='text-info'>Back to Login</a>"

}

function load_script() { //specify commonly used JS and CSS here. Generates for every page.
    var js_scripts = [
        'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js',
        // "js/jquery.inview.min.js",
    ];

    var css_scripts = [
        "https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css",
        "https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap",
        "https://fonts.googleapis.com/css2?family=Lobster&display=swap",
        'https://fonts.googleapis.com/css?family=Sonsie One',
        "https://fonts.googleapis.com/css?family=Rubik",
        "https://pro.fontawesome.com/releases/v5.10.0/css/all.css",
        "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css",
        "css/typewriter.css",
        "css/main.css",
    ];

    js_scripts.forEach(function (filename) {
        var fileref = document.createElement('script');
        fileref.setAttribute("type", "text/javascript");
        fileref.setAttribute("src", filename);
        document.getElementsByTagName("head")[0].appendChild(fileref);
    });

    css_scripts.forEach(function (filename) {
        var fileref = document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
        document.getElementsByTagName("head")[0].appendChild(fileref);
    });
}

function display_back_to_top_button() {
    if (!document.getElementById("back-to-top")) {
        var el = document.createElement("div");
        el.setAttribute("id", "back-to-top");
        el.setAttribute("class", "text-center");
        var text = document.createTextNode("^");
        el.appendChild(text);
        document.getElementsByTagName("body")[0].appendChild(el);
        document.getElementById('back-to-top').addEventListener('click', function (e) {
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        })
    }
}




function processLogin(username_input, pwd_input) {
    const web = new XMLHttpRequest();
    var response = '';
    var details_obj = {
        username: username_input,
        password: pwd_input
    };

    var details = JSON.stringify(details_obj);

    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            console.log(this.responseText);
            // jsObj = JSON.parse(this.responseText);
            response = this.responseText
        }
    };

    web.open('POST', "php/process_login.php", false);
    web.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    web.send('query=' + details);

    return response
}

function processLogout() {
    const web = new XMLHttpRequest();
    var response = '';
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            console.log(this.responseText);
            response = this.responseText
        }
    };

    web.open('POST', "php/logout.php", false);
    web.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    web.send();

    return response
}

function processRegister(username_input, pwd_input, cfmpassword_input, email_input) {
    // username_input, pwd_input, cfmpassword_input, email_input (if need input)
    var response = '';
    const web = new XMLHttpRequest();
    var details_obj = {
        username: username_input,
        password: pwd_input,
        confirm: cfmpassword_input,
        email: email_input
    };

    var details = JSON.stringify(details_obj);

    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            response = this.responseText;
            // console.log("asdasd");
            // console.log(response);
            // return this.responseText;
            // jsObj = JSON.parse(this.responseText);
        }
    };

    web.open('POST', "php/register.php", false);
    web.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    web.send('query=' + details);

    return response
}