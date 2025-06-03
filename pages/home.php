<?php 
    if (isUserLoggedIn()){
        $user = GetUserDetailsByUID($_SESSION["user"]["id"]);
    }
?>

<?php require "parts/header.php"; ?>

<!-- navbar start -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Real Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a href="/find-doctor" class="nav-link">Find a Doctor</a>
        </li>
    <?php if ( isUserLoggedIn() ) : ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $user["name"]; ?>
            </a>
            <ul class="dropdown-menu">
                <li>         
                    <?php if(isAdmin()) : ?>
                        <a href="/admin/dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php elseif (isDoctor()) : ?>
                        <a href="/doctor/redirect-dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php else : ?>
                        <a href="/patient/redirect-dashboard" class="dropdown-item">Access the Dashboard</a>
                    <?php endif; ?>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </li>
      </ul>
    <?php else : ?>
        <li class="nav-item">
            <a href="/login" class="nav-link">Login</a>
        </li>
    <?php endif; ?>
    </div>
  </div>
</nav>
<!-- navbar end -->

<!-- carousel start -->
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel"> 
        <div class="carousel-indicators"> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button> 
        </div>
        <div class="carousel-inner"> 
            <div class="carousel-item"> 
                <div class="mask">
                    <img src="https://www.thomsonhospitals.com/wp-content/uploads/2024/09/Suite_Room_6-2.jpg" style="height:60vh; width:100vw; object-fit:cover;">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black text-end"> 
                        <h1>Example headline.</h1> 
                        <p>Some representative placeholder content for the first slide of the carousel.</p> 
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div> 
                </div> 
            </div> 
            <div class="carousel-item"> 
                <div class="mask">
                    <img src="https://www.ihhhealthcare.com/images/ihhmylibraries/careers/doctor-bg-copy.webp?sfvrsn=75b022dc_1" style="height:60vh; width:100vw; object-fit:cover; object-position:100% 30%">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black"> 
                        <h1>Another example headline.</h1> 
                        <p>Some representative placeholder content for the second slide of the carousel.</p> 
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> 
                    </div> 
                </div> 
            </div> 
            <div class="carousel-item active"> 
                <div class="mask">
                    <img src="https://islandhospital.com/wp-content/uploads/2023/01/hospital-about-us-patient-42.jpg" style="height:60vh; width:100vw; object-fit:cover;">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black text-start"> 
                        <h1>One more for good measure.</h1> 
                        <p>Some representative placeholder content for the third slide of this carousel.</p> 
                        <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p> 
                    </div> 
                </div> 
            </div> 
        </div> 
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev"> 
            <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> 
        </button> 
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next"> 
            <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> 
        </button> 
    </div>
<!-- carousel end -->
<?php require "parts/footer.php"; ?>