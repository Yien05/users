<?php

 // make sure the post is logged in
 if ( !isUserLoggedIn() ) {
    // if is not logged in, redirect to /login page
    header("Location: /login");
    exit;
}

    // connect to database
    $database = connectToDB();

    // get id from USER
    $user_id = $_POST["user_id"];

    // delete post
    $sql = "DELETE FROM posts where id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
        "id" => $user_id
    ]);

    // confirm post deletion
    $_SESSION["success"] = "Post deleted.";

    // redirect to Manage Posts
    header("Location: /manage-posts");
    exit;