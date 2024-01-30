<?php require "parts/header.php"; 
?>
    <div class="container my-5 mx-auto" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">Login</h1>

      <?php require "parts/error_box.php"; ?>

      <div class="card p-4">
        <form method="GET" action="dashboard.html">
          <div class="mb-2">
            <label for="email" class="visually-hidden">Email</label>
            <input
              type="text"
              class="form-control"
              id="email"
              placeholder="email@example.com"
            />
          </div>
          <div class="mb-2">
            <label for="password" class="visually-hidden">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Password"
            />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>

      <!-- links -->
      <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
      >
        <a href="index.html" class="text-decoration-none small"
          ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
        <a href="signup.html" class="text-decoration-none small"
          >Don't have an account? Sign up here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
      </div>
    </div>
     <!-- Go back link -->
     <div class="text-center">
      <a href="/" class="text-decoration-none"
        ><i class="bi bi-arrow-left-circle"></i> Go back</a
      >
    </div>

    <?php 
    require "parts/footer.php";