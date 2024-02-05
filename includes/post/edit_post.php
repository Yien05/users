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
    $post_id = $_POST['post_id'];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];

    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    if ( empty( $title ) || empty( $content ) || empty( $status ) ) {
        setError( 'All the fields are required', '/manage-posts-edit?id=' . $post_id );
    } else {
        // Step 4: make sure the content entered wasn't already exists in the database
        $sql = "SELECT * FROM posts where content = :content AND id != :id";
        $query = $database->prepare( $sql );
        $query->execute([
            'content' => $content,
            'id' => $post_id
        ]);
        $post = $query->fetch(); // get only one row of data

        if ( empty( $post ) ) {
            // Step 5: update the post data
            $sql = "UPDATE posts SET name = :title, content = :content, status = :status WHERE id = :id";
            $query = $database->prepare( $sql );
            $query->execute([
                'title' => $title,
                'content' => $content,
                'status' => $status,
                'id' => $post_id,
                'name' => $content
            ]);
    
            // Step 6: redirect back to /manage-post$posts page
            $_SESSION["success"] = "Post data has been updated successfully.";
            header("Location: /manage-posts");
            exit;
        } else {
            setError("The content provided has already been used.",'/manage-posts-edit?id=' . $post_id);
        } // end - $post

    } // end - step 3


