<?php

 // make sure the post is logged in
 if ( !isUserLoggedIn() ) {
    // if is not logged in, redirect to /login page
    header("Location: /login");
    exit;
}

    // Step 1: connect to the database
    $database = connectToDB();

    // Step 2: get all the data from the form using $_POST
    $title = $_POST["title"];
    $content = $_POST["content"];
    


    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    if ( empty( $title ) || empty( $content )  ) {
        setError( "All the fields are required.", '/manage-posts' );
    }else {
        // step 5: make sure the content entered does not exists yet
        $sql = "INSERT INTO posts (`title`,`content`,`user_id`) VALUES (:title, :content,:user_id)";
            // 6.2 - prepare (put everything into th bowl)
            $query = $database->prepare( $sql );
            // 6.3 - execute (cook it)
            $query->execute([
                'title' => $title,
                'content' => $content,
                'user_id' => $_SESSION['user']['id']
               
            ]);
    
        $user = $query->fetch(); // get only one row of data

            // step 7: redirect back to /manage-posts page
            $_SESSION["success"] = "New post has been created.";
            header("Location: /manage-posts");
            exit;
        }