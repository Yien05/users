<?php 

    // start a session
    session_start();

    // require the functions
    require "includes/functions.php";

    // get the current path the user is on
    $path = $_SERVER["REQUEST_URI"];
    // remove all the query string from the URL
    $path = parse_url( $path, PHP_URL_PATH );
    // trim out the beginning slash
    $path = trim( $path, '/' );

    // determine what to do based the user action
    switch( $path ) {
        // actions routes
        case 'auth/login':
            require 'includes/auth/login.php';
            break;
        case 'auth/signup':
            require 'includes/auth/signup.php';
            break;
        case 'logout':
            require "includes/auth/logout.php";
            break;
        case 'user/add':
            require "includes/user/add.php";
            break;
        case 'user/edit':
            require "includes/user/edit.php";
            break;
        case 'user/delete':
            require "includes/user/delete.php";
            break;
        case 'user/changepwd':
            require "includes/user/changepwd.php";
            break;
        case 'post/add':
            require "includes/post/add.php";
            break;
        case 'post/edit':
            require "includes/post/edit.php";
            break;
        case 'post/delete':
            require "includes/post/delete.php";
            break;    

        // pages routes
        case 'login':
            $page_title = "Login";
            require 'pages/login.php';
            break;
        case 'signup':
            $page_title = "Sign Up";
            require 'pages/signup.php';
            break;
        case 'logout':
            $page_title = "Logout";
            require 'pages/logout.php';
            break;
        case 'dashboard':
            $page_title = "Dashboard";
            require 'pages/dashboard.php';
            break;
        case 'post':
            $page_title = "Post";
            require 'pages/post.php';
            break;
        case 'manage-users':
             $page_title = "Manage Users";
             require 'pages/manage-users.php';
             break;
        case 'manage-users-add':
             $page_title = "Add New User";
             require 'pages/manage-users-add.php';
             break;
        case 'manage-users-edit':
            $page_title = "Edit Usert";
            require 'pages/manage-users-edit.php';
            break;
        case 'manage-users-changepwd':
            $page_title = "Change Password";
            require 'pages/manage-users-changepwd.php';
            break;
        case 'manage-posts':
            $page_title = "Manage Posts";
            require 'pages/manage-posts.php';
            break;
        case 'manage-posts-add':
            $page_title = "Add New Post";
            require 'pages/manage-posts-add.php';
            break;
        case 'manage-posts-edit':
            $page_title = "Edit Post";
            require 'pages/manage-posts-edit.php';
            break;

        default:
            $page_title = "Home";
            require "pages/home.php";
            break;
    }