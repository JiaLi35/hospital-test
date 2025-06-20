<?php

// check if the user is not an admin (must be at very top)
  if( !isAdmin() ){
    header("Location: /");
    exit;
  }

  $search_keyword = isset($_GET["search"]) ? $_GET["search"] : "";

  // TODO: 1. connect to database
  $database = connectToDB();
  // TODO: 2. get all the users
  // TODO: 2.1
  $sql = "SELECT * FROM doctors
          WHERE name LIKE :keyword
          ORDER BY doctors.id DESC";
  // TODO: 2.2
  $query = $database->prepare( $sql );
  // TODO: 2.3
  $query->execute([
    "keyword" => "%$search_keyword%"
  ]);
  // TODO: 2.4
  $doctors = $query->fetchAll();
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

    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Doctors</h1>
        <div class="text-end">
          <a href="/manage-doctors-add-user" class="btn btn-primary btn-sm">Add New Doctor</a>
        </div>
      </div>
      <form
        method="GET"
        action="/manage-doctors" 
        class="mb-2 d-flex align-items center gap-2">
        <input type="text" name="search" class="form-control" placeholder="Type a keyword to search..." value="<?=$search_keyword;?>">
        <button class="btn btn-primary"><i class="bi bi-search"></i></button> 
        <a href="/manage-doctors" class="btn btn-dark">Reset</a>
      </form>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Specialty</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Email</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: 3. use foreach to dsiplay all the users  -->
            <?php foreach ($doctors as $index => $doctor) : ?>
              <tr>
                <th scope="row"><?= $doctor["id"] ?></th>
                <td>          
                  <?php if (!empty($doctor["image"])) : ?>
                    <img src="/<?= $doctor["image"]; ?>" style="width: 100px; height: 100px; object-fit:cover;">
                  <?php endif; ?>
                </td>
                <td><?= $doctor["name"] ?></td>
                <td><?= $doctor["specialty"] ?></td>
                <td><?= $doctor["phone_number"] ?></td>
                <td><?= $doctor["email"] ?></td>

                <td class="text-end">
                  <div class="d-flex justify-content-end">
                    <a
                      href="/manage-doctors-edit?id=<?= $doctor["id"]; ?>"
                      class="btn btn-success btn-sm me-2"
                      ><i class="bi bi-pencil"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

<?php require "parts/footer.php"; ?>
