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
    <div class="navbar" id="navbarSupportedContent">
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
            <ul class="dropdown-menu" style="left:-130%;">
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
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel"> 
        <div class="carousel-indicators"> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button> 
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button> 
        </div>
        <div class="carousel-inner"> 
            <div class="carousel-item active"> 
                <div id="mask">
                    <img src="https://www.thomsonhospitals.com/wp-content/uploads/2024/09/Suite_Room_6-2.jpg" style="height:65vh; width:100vw; object-fit:cover;">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black text-start"> 
                        <h1>5 Star Accommadation & Services</h1> 
                        <p>Just as comfortable as your own home.</p> 
                        <p><a class="btn btn-lg btn-primary" href="/">Browse Gallery</a></p>
                    </div> 
                </div> 
            </div> 
            <div class="carousel-item"> 
                <div id="mask">
                    <img src="https://www.ihhhealthcare.com/images/ihhmylibraries/careers/doctor-bg-copy.webp?sfvrsn=75b022dc_1" style="height:65vh; width:100vw; object-fit:cover; object-position:100% 30%">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black"> 
                        <h1>Certified Doctors</h1> 
                        <p>Guranteed for the best quality healthcare!</p> 
                        <p><a class="btn btn-lg btn-primary" href="/find-doctor">Book an Appointment</a></p> 
                    </div> 
                </div> 
            </div> 
            <div class="carousel-item"> 
                <div id="mask">
                    <img src="https://islandhospital.com/wp-content/uploads/2023/01/hospital-about-us-patient-42.jpg" style="height:65vh; width:100vw; object-fit:cover;">
                </div>
                <div class="container"> 
                    <div class="carousel-caption text-black text-end"> 
                        <h1>We Care for Life</h1> 
                        <p>Your most trusted healthcare partner.</p> 
                        <p><a class="btn btn-lg btn-primary" href="/sign-up">Sign Up Today</a></p> 
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

<!-- buttons start -->
<div class="mx-5 my-5 d-flex justify-content-center align-items-center">
  <a href="/" class="btn flex-fill py-3 text-white" style="background-color: #6cc16e; border-radius: 12px 0 0 12px;">
    <i class="bi bi-calendar-event me-2"></i>
    Events & Charities
  </a>
  <a href="/find-doctor" class="btn flex-fill py-3 text-white rounded-0" style="background-color: #f5b940;">
    <i class="bi bi-search me-2"></i>
    Find a Doctor
  </a>
  <a href="#packages" class="btn flex-fill py-3 text-white" style="background-color: #3cc0e7; border-radius: 0 12px 12px 0;">
    <i class="bi bi-clipboard2-pulse me-2"></i>
    Health Screening Packages
  </a>
</div>
<!-- buttons end -->

<!-- packages start -->
<div class="container text-center my-5 p-5 fs-5" id="packages">
    <h1 class="my-5"> Packages & Promotions </h1>
    <p> 
        Our health packages provide top-quality preventive care for individuals and families. With a focus on care for life, we offer screenings and tests to detect potential health issues early, supporting well-being and peace of mind.
    </p>
</div>

<div class="container my-5">
    <div class="row">
        <!-- column start -->
        <div class="col">
            <div class="card">
                <img src="https://media.post.rvohealth.io/wp-content/uploads/sites/3/2022/08/eye_doctors_GettyImages1305317626_Thumb.jpg" class="card-img-top" alt="Eye" style="height:250px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Cataract Package</h5>
                    <p class="card-text">Validity: 2025/06/05 - 2025/08/04</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <!-- column end -->
        <!-- column start -->
        <div class="col">
            <div class="card">
                <img src="https://images.ctfassets.net/szez98lehkfm/5neyIVTpBbHEYK4t8BLFen/4dffc104d387fb3d70b7836137a565a8/MyIC_Article_92668?w=730&h=410&fm=jpg&fit=fill" class="card-img-top" alt="Physiotherapy" style="height:250px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Physiotherapy Package</h5>
                    <p class="card-text">Validity: 2025/06/05 - 2025/10/31</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <!-- column end -->
        <!-- column start -->
        <div class="col">
            <div class="card">
                <img src="https://aradamansaramedicalcentre.com/storage/app/media/2025/4/health-screening-banner-mobile.png" class="card-img-top" alt="..." style="height:250px; object-fit:cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Health Screening Package</h5>
                    <p class="card-text">Validity: 2025/06/01 - 2025/09/30</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <!-- column end -->
    </div>
</div>
<!-- packages end -->

<footer class="p-3 bg-white d-flex justify-content-center h-100 align-items-center">
    <p class="m-0"> © Jia Li 2025 </p>
</footer>

<?php require "parts/footer.php"; ?>