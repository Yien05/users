<?php
    // make sure the user is logged in
    if ( !isUserLoggedIn() ) {
        // if is not logged in, redirect to /login page
        header("Location: /login");
        exit;
    }

    // Step 1: connect to the database
    $database = connectToDB();

    // Step 2: get all the data from the form using $_POST
    $id = $_POST['post_id'];
    $title = $_POST["title"];
    $status = $_POST["status"];
    $content = $_POST["content"];

    // capture the image file
    $image = $_FILES["image"];

    // make sure that you only upload if image is available
    if ( !empty( $image['name'] ) ) {
        $target_dir = "uploads/";
        // add the image name to the uploads folder path
        $target_path = $target_dir . time() . '_' . basename( $image['name'] ); // uploads/892938829293_image.jpg
        // move the file to the uploads folder
        move_uploaded_file( $image["tmp_name"], $target_path );
    }
    
    // Step 3: error checking
    // 3.1 make sure all the fields are not empty
    if ( empty( $title ) || empty( $content ) || empty( $status )) {
        setError( 'All the fields are required', '/manage-post-edit?id=' . $id );
    } else { 
        // Step 5: update the user data
        $sql = "UPDATE posts 
            SET title = :title , status = :status , content = :content, image = :image
            WHERE id = :id";
        $query = $database->prepare( $sql );
        $query->execute([
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'image' => !empty( $image['name'] ) ? $target_path : $_POST['original_image'],
            'id' => $id
        ]);

        // Step 6: redirect back to /manage-posts page
        $_SESSION["success"] = "Post has been updated successfully.";
        header("Location: /manage-posts");
        exit;
        
    } // end - step 3


