<?php

  // Step 2: connect to the database
  $database = connectToDB();

  // step 3: get student id and updated name from $_POST
  $users_name = $_POST["users_name"];
  $users_id = $_POST["users_id"];

  // do error checking. Check if student name is empty or not
  if ( empty( $users_name ) ) {
    setError( 'Please enter a name', '/' );
  } else {
    // Step 4: update the name in database
        // 4.1 - sql command (recipe)
        $sql = "UPDATE students SET name = :name WHERE id = :id";
        // 4.2 - prepare (put everything into the bowl)
        $query = $database->prepare( $sql );
        // 4.3 - execute (cook it)
        $query->execute([
            'name' => $users_name,
            'id' => $users_id
        ]);

    // Step 5: redirect back to home page
    header("Location: /");
    exit;

  }