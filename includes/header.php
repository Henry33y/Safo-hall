<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/images/safo web logo.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
  <script src="js/jquery.steps.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <link rel="stylesheet" href="style.css">
  <title><?php echo $title ?></title>
</head>

<body class="min-vh-100 position-relative registerBody">
  <nav class="navbar navbar-expand-lg registerNavBar py-0 shadow-sm position-fixed w-100 top-0 bg-white" style="z-index: 9;">
    <d class="container-fluid">
      <a class="navbar-brand d-flex" href="/">
        <img class="d-inline-block logo img-fluid" style="height:auto;" src="./assets/images/safo web logo.png"
          alt=""><span class="logo-text d-flex align-items-center">SAFO HALL</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="sidebarMenu">
        <ul class="nav navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link desktop-nav-link register_nav_link" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link desktop-nav-link register_nav_link" href="register">Register</a>
          </li>
          <?php if(isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'viewRegisteredStudents'){?>
          <li class="nav-item">
            <a class="nav-link desktop-nav-link register_nav_link" href="viewRegisteredStudents">Student Info</a>
          </li>
          <?php }else{
            echo '';
          } ?>
          <?php if(isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) != 'viewRooms'){?>
          <li class="nav-item">
            <a class="nav-link desktop-nav-link register_nav_link" href="viewRooms">Rooms</a>
          </li>
          <?php } else{ echo '';}?>
          <li class="nav-item d-lg-inline-block">
            <?php
            if (!isset($_SESSION['username'])) {
              ?>
              <a class="nav-link desktop-nav-link register_nav_link" href="login">Login</a>
            <?php } else { ?>
              <div class="dropdown d-none d-lg-block">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if(isset($_SESSION['username'])){ ?>
                        <span><i class="bi bi-person-circle me-2"></i>Hello <?php echo ucwords($_SESSION['username']) ?> !</span>
                    <?php } ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="adduser"><i class="bi bi-person-add me-2"></i>Add User</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout"><i class="bi bi-power me-2"></i>Logout</a></li>
                </ul>
              </div>
              
              <!-- <a class="nav-item nav-link desktop-nav-link register_nav_link" href="logout">Logout</a> -->
            </li>
            <li class="nav-item d-lg-none">
              <a class="nav-link desktop-nav-link register_nav_link" href="adduser"><i class="bi bi-person-add me-2"></i>Add User</a>
            </li>
            <li class="nav-item d-lg-none">
              <a class="nav-link desktop-nav-link register_nav_link" href="logout"><i class="bi bi-power me-2"></i>Logout</a>
            </li>
            <?php } ?>

        </ul>
        <!-- <span class="navbar-text">
        Navbar text with an inline element
      </span> -->
      </div>
      </div>
  </nav>