<?php 
    $title = 'Dashboard';

    require_once 'includes/session.php';
    require_once 'includes/header.php';
    // require_once 'includes/auth_check.php';
    require_once 'includes/db_conn.php';

    print_r($_SESSION)
?>
<div class="row h-100">
    <div class="col-md-3 col-lg-3 p-0">
        <div class="offcanvas-md offcanvas-start border" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header"></div>
            <div class="offcanvas-body">
                <ul class="nav flex-column w-100">
                    <li class="nav-item w-100"><a class="nav-link sidebar-link" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                    <li class="nav-item sidebar-item">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 w-100" data-bs-toggle="collapse" data-bs-target="#student_collapse" aria-expanded="false"><i class="bi bi-mortarboard me-2"></i>Students</button>
                        <div class="collapse" id="student_collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Updates</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Reports</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 w-100" data-bs-toggle="collapse" data-bs-target="#users_collapse" aria-expanded="false"><i class="bi bi-people me-2"></i>Users</button>
                        <div class="collapse" id="users_collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Updates</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Reports</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="logout.php" class="nav-link sidebar-link"><i class="bi bi-power me-2"></i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <gmp-map center="40.731,-73.997" zoom="8" map-id="DEMO_MAP_ID">
            <div id="floating-panel" slot="control-block-start-inline-center">
            <input id="latlng" type="text" value="40.714224,-73.961452"/>
            <input id="submit" type="button" value="Reverse Geocode"/>
            </div>
            <gmp-advanced-marker></gmp-advanced-marker>
        </gmp-map>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOVYRIgupAurZup5y1PRh8Ismb1A3lLao&callback=initMap&libraries=marker&v=beta&solution_channel=GMP_CCS_reversegeocoding_v2" defer></script>
    </div>
</div>

<script defer>
    /* global bootstrap: false */
(() => {
  'use strict'
  const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(tooltipTriggerEl => {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })
})()

</script>