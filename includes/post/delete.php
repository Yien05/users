<?php

    // make sure the user is logged in
    if ( !isUserLoggedIn() ) {
        // if is not logged in, redirect to /login page
        header("Location: /login");
        exit;
    }

    // connect to database
    $database = connectToDB();

    // get id from POST
    $id = $_POST["post_id"];

    // delete post
    $sql = "DELETE FROM posts where id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
        "id" => $id
    ]);

    $_SESSION["success"] = "Post has been deleted.";
    header("Location: /manage-posts");
    exit;
