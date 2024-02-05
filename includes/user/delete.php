<?php

 // make sure the user is logged in
 if ( !isUserLoggedIn() ) {
    // if is not logged in, redirect to /login page
    header("Location: /login");
    exit;
}

// make sure only admin can perform this action
if ( !isAdmin() ) {
    // if is not admin, then redirect the user back to /dashboard
    header("Location: /dashboard");
    exit;
}

    // connect to database
    $database = connectToDB();

    // get id from POST
    $user_id = $_POST["user_id"];

    // delete user
    $sql = "DELETE FROM users where id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
        "id" => $user_id
    ]);

    // confirm user deletion
    $_SESSION["success"] = "User deleted.";

    // redirect to Manage Users
    header("Location: /manage-users");
    exit;