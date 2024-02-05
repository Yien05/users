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

    // Step 1: load the database
    $database = connectToDB();

    // Step 2: get all the $_POST data
    $user_id = $_POST["user_id"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Step 3: check for error
    // 3.1 - make sure all the fields are not empty
    // 3.2 - make sure the password is match
    // 3.3 - make sure the password length is at least 8 characters
    if ( empty( $password ) || empty( $confirm_password ) ) {
        setError("All the fields are required.", '/manage-users-changepwd?id=' . $user_id );
    } else if ( $password !== $confirm_password ) {
        // 4.2 - make sure password is match
        setError( "The password is not match",  '/manage-users-changepwd?id=' . $user_id );
    } else if ( strlen( $password ) < 8 ) {
        // 4.3 - make sure the password length is at least 8 chars
        setError( "Your password must be at least 8 characters",  '/manage-users-changepwd?id=' . $user_id );
    } 

    // Step 4: update the password
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        'password' => password_hash( $password, PASSWORD_DEFAULT ),
        'id' => $user_id
    ]);

    // Step 5: redirect back to /manage-users page
    $_SESSION["success"] = "Password has been updated.";
    header("Location: /manage-users");
    exit;