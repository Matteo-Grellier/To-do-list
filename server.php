<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// //setup header and footer
// require("public/templates/includes/headerView.php");
// require("public/templates/includes/footerView.php");

// if($url == '/') {
//     //setup the main page
//     require("public/templates/indexView.php");
// } else if($url == "/register") {
//     require("public/templates/registerView.php");
// } else if($url == "/login") {
//     require("public/templates/loginView.php");
// } else {
//     // require_once __DIR__ . "public/static/css/style.css";
//     return false;
// }

// //display all
// require("public/templates/layout.php");

if($url == '/') {
    //setup the main page
    require("public/templates/indexView.php");
} else if($url == "/register") {
    require("public/templates/registerView.php");
} else if($url == "/login") {
    require("public/templates/loginView.php");
} else {
    // require_once __DIR__ . "public/static/css/style.css";
    return false;
}
