<?php

// check if the user is not an admin (must be at very top)
  if( !isAdmin() ){
    header("Location: /");
    exit;
  }

  if (isset($_GET["filter"]) === true) {
    $filter_keyword = $_GET["filter"];

    // TODO: 1. connect to database
    $database = connectToDB();
    // TODO: 2. get all the users
    $sql = "SELECT * FROM users 
            WHERE role = :keyword
            ORDER BY id DESC";
    // TODO: 2.2
    $query = $database->prepare( $sql );
    // TODO: 2.3
    $query->execute([
      "keyword" => $filter_keyword
    ]);
    // TODO: 2.4 fetch
    $users = $query->fetchAll(); // get only the first row of the match data
    } else {
      // TODO: 1. connect to database
      $database = connectToDB();
      // TODO: 2. get all the users
      // TODO: 2.1
      $sql = "SELECT * FROM users ORDER BY id DESC";
      // TODO: 2.2
      $query = $database->prepare( $sql );
      // TODO: 2.3
      $query->execute();
      // TODO: 2.4
      $users = $query->fetchAll();
    }

?>

<?php require "parts/header.php"; ?>
<!-- navbar start -->
<nav class="navbar bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin/dashboard">
      <i class="bi bi-arrow-left mx-3"></i>Back
    </a>
  </div>
</nav>
<!-- navbar end -->
 
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Users</h1>
        <!-- sort start -->
        <form method="GET" action="/manage-users" class="d-flex justify-content-center gap-3">
            <?php if (isset($_GET["filter"]) === true) : ?>
            <select name="filter">
                <option selected disabled hidden>Select a Role</option>
                <option value="Patient" <?= ($filter_keyword === "Patient" ? "selected" : ""); ?>>Patient</option>
                <option value="Doctor" <?= ($filter_keyword === "Doctor" ? "selected" : ""); ?>>Doctor</option>
                <option value="admin" <?= ($filter_keyword === "admin" ? "selected" : ""); ?>>Admin</option>
            </select>
            <?php else : ?>
            <select name="filter">
                <option selected disabled hidden>Select a Role</option>
                <option value="Patient">Patient</option>
                <option value="Doctor">Doctor</option>
                <option value="admin">Admin</option>
            </select>
            <?php endif; ?>
          <button class="btn btn-sm btn-primary">Sort</button>
          <a href="/manage-users" class="btn btn-dark">Reset</a>
        </form>
        <!-- sort end -->
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- display all the users  -->
            <?php foreach ($users as $index => $user) : ?>
              <tr>
                <th scope="row"><?= $user["id"]; ?></th>
                <td><?= $user["name"]; ?></td>
                <td><?= $user["email"]; ?></td>

                <?php if($user["role"] === "Patient") : ?>
                  <td><span class="badge bg-success"><?= $user["role"] ?></span></td>
                <?php elseif ($user["role"] == "Doctor") : ?>
                  <td><span class="badge bg-info"><?= $user["role"] ?></span></td>
                <?php else : ?>
                  <td><span class="badge bg-primary"><?= $user["role"] ?></span></td>
                <?php endif; ?>

                <td class="text-end">
                  <div class="d-flex justify-content-end">
                    <a
                      href="/changepwd?id=<?= $user["id"]; ?>"
                      class="btn btn-warning btn-sm me-2"
                      ><i class="bi bi-key"></i
                    ></a>
                  <!-- Button to trigger delete confirmation modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#userDeleteModal-<?= $user["id"]; ?>">
                  <i class="bi bi-trash"></i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="userDeleteModal-<?= $user["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this user?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>You are tyring to delete this user: <?= $user["email"]; ?></p>
                          <p>This action cannot be reversed.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <!-- delete button start -->
                          <form method="POST" action="/user/delete">
                            <input type="hidden" name="id" value="<?= $user["id"]?>">
                            <button class="btn btn-danger btn-sm">
                              <i class="bi bi-trash"></i> DELETE
                            </button>
                          </form>
                          <!-- delete button end -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Modal -->
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

<?php require "parts/footer.php"; ?>
