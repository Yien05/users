<?php 

 // make sure the post is logged in
 if ( !isUserLoggedIn() ) {
  // if is not logged in, redirect to /login page
  header("Location: /login");
  exit;
}

// load database
$database = connectToDB();

// get all the users
// 1. sql command
$sql = "SELECT * from posts ORDER BY id DESC"; // order by ID DESC
// 2. prepare
$query = $database->prepare( $sql );
// 3. execute
$query->execute();
// 4. fetchAll
$posts = $query->fetchAll();

require "parts/header.php"; ?>
  <div class="container mx-auto my-5" style="max-width: 700px">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h1">Manage Posts</h1>
      <div class="text-end">
        <a href="/manage-posts-add" class="btn btn-primary btn-sm"
          >Add New Post</a
        >
      </div>
    </div>
    <div class="card mb-2 p-4">
    <?php require "parts/message_success.php"; ?>
      <table class="table ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col" style="width: 40%">Title</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach( $posts as $post ) : ?>
          <!-- pending reverseArray foreach, post data table, query row-specific data -->
          <tr>
            <th scope="row"><?= $post["id"]; ?></th>
            <td><?= $post["title"]; ?></td>
            <td>
                <?php if ( $post["status"] === 'pending' ) : ?>
                  <span class="badge bg-primary">Pending for Review</span>
                <?php endif; ?>

                <?php if ( $post["status"] === 'publish' ) : ?>
                  <span class="badge bg-info">Publish</span>
                <?php endif; ?>

                </td>
            <td class="text-end">
              <div class="buttons">
                <a
                  href="/post?id=<?= $post["id"]; ?>"
                  target="_blank"
                  class="btn btn-primary btn-sm me-2 disabled"
                  ><i class="bi bi-eye"></i
                ></a>
                <a
                  href="/manage-posts-edit?id=<?= $post["id"]; ?>"
                  class="btn btn-secondary btn-sm me-2"
                  ><i class="bi bi-pencil"></i
                ></a>
                <form>
                    <button class="btn btn-danger btn-sm"
                     type="button" 
                     <?= ( $post["id"] == $_SESSION["post"]['id'] ? "disabled" : "" ); ?>
                    data-bs-toggle="modal" 
                    data-bs-target="#delete-post-model-<?= $post["id"]; ?>">
                      <i class="bi bi-trash"></i></button> 
                </form>

              </div>
            </td>
          </tr>
          <!-- end of foreach -->
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="text-center">
      <a href="/dashboard" class="btn btn-link btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
      >
    </div>
  </div>

<?php require "parts/footer.php";