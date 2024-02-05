<?php

 // make sure the user is logged in
 if ( !isUserLoggedIn() ) {
    // if is not logged in, redirect to /login page
    header("Location: /login");
    exit;
}

// make sure only admin can see this page
if ( !isAdmin() ) {
    // if is not admin, then redirect the user back to /dashboard
    header("Location: /dashboard");
    exit;
}

    // Step 1: connect to the database
    $database = connectToDB();

    // Step 2: get all the data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];


    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    // 3.2 - make sure password is match
    // 3.3 - make sure the password length is at least 8 chars
    if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) || empty( $role ) ) {
        setError( "All the fields are required.", '/manage-users' );
    } else if ( $password !== $confirm_password ) {
        // 4.2 - make sure password is match
        setError( "The password is not match", '/manage-users' );
    } else if ( strlen( $password ) < 8 ) {
        // 4.3 - make sure the password length is at least 8 chars
        setError( "Your password must be at least 8 characters", '/manage-users' );
    } else {
        // step 5: make sure the email entered does not exists yet
        $sql = "SELECT * FROM users where email = :email";
        $query = $database->prepare( $sql );
        $query->execute([
            'email' => $email
        ]);
        $user = $query->fetch(); // get only one row of data

        if ( empty( $user ) ) {
            // step 6: create the user account. Remember to assign role to the user
            // 6.1 - sql command (recipe)
            $sql = "INSERT INTO users (`name`,`email`,`password`,`role`) VALUES (:name, :email, :password, :role)";
            // 6.2 - prepare (put everything into th bowl)
            $query = $database->prepare( $sql );
            // 6.3 - execute (cook it)
            $query->execute([
                'name' => $name,
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_DEFAULT ),
                'role' => $role
            ]);

            // step 7: redirect back to /manage-users page
            $_SESSION["success"] = "New user has been created.";
            header("Location: /manage-users");
            exit;
        } else {
            setError("The email provided has already been used.","/manage-users-add");
        } // end - empty( $user )

    } // end - step 3

    
