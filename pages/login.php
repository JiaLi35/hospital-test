<?php require "parts/header.php"; ?>

<div class="row m-0 p-0">
  <div class="col m-0 p-0">
    <img src="https://www.bcie.org/fileadmin/_processed_/6/a/csm_hospital_web_b185b30ce1.jpg" style="height:100vh;">
  </div>
  <div class="col m-0 p-0 d-flex justify-content-center align-items-center">
    <div class="my-5">
      <h1 class="h1 mb-4 text-center">Login</h1>
        <!-- display success message -->
        <?php require "parts/message_success.php"; ?>
        <!-- display error message -->
        <?php require "parts/message_error.php"; ?>

        <!-- login form -->
        <form method="POST" action="/auth/login">
          <div class="mb-2">
            <label for="email" class="visually-hidden">Email</label>
            <input
              type="text"
              class="form-control"
              id="email"
              placeholder="email@example.com"
              name="email"
            />
          </div>
          <div class="mb-2">
            <label for="password" class="visually-hidden">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Password"
              name="password"
            />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>

      <!-- links -->
      <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
      >
        <a href="/" class="text-decoration-none small"
          ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
        <a href="/signup" class="text-decoration-none small"
          >Don't have an account? Sign up here
          <i class="bi bi-arrow-right-circle"></i
        ></a>
    </div>
  </div>
</div>

<?php require "parts/footer.php"; ?>
