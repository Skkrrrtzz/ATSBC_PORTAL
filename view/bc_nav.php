  <?php ini_set('session.gc_maxlifetime', 7200);
    session_start();
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 7200)) {
        // The session has expired, log the user out
        session_unset();
        session_destroy();

        header('location: bc_login.php');
        exit();
    } elseif (empty($_SESSION['Emp_ID'])) {
        header('location: bc_login.php');
        exit();
    } else {
        // Update the last activity time
        date_default_timezone_set("Asia/Manila"); // set default timezone
        $_SESSION['last_activity'] = time();
        $Name = $_SESSION['Name'];
        $Emp_ID = $_SESSION['Emp_ID'];
        $Dept = $_SESSION['Department'];
        $Role = $_SESSION['Role'];
        $Email = $_SESSION['Email'];
        $Position = $_SESSION['Position'];
        $currentDate = date("m/d/Y");
        $ccp_checked_date = date('Y-m-d H:i:s');
        $ini_time = strtotime($ccp_checked_date);
        $date_time = date('m/d/y h:i A', $ini_time);
        // $words = explode(' ', $Name);
        // $firstName = $words[0];
        function formatApprovalDate($date)
        {
            $timestamp = strtotime($date);
            return date('m/d/Y h:i A', $timestamp);
        }
    ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>ATS Business Control Portal</title>
          <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
          <link rel="stylesheet" href="../assets/css/mdb.min.css" />
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="../assets/css/fontawesome-6.3.0/css/all.min.css">
          <link rel="stylesheet" href="../assets/DataTables/datatables.min.css">
          <link rel="stylesheet" href="../assets/icons/font/bootstrap-icons.min.css">
          <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
          <script src="../assets/js/mdb.min.js"></script>
          <script src="../assets/js/jquery-3.6.0.min.js"></script>
          <script src="../assets/DataTables/datatables.min.js"></script>
          <script src="../assets/js/sweetalert2.all.min.js"></script>

          <style>
              h4,
              h6,
              h5 {
                  font-family: 'Poppins', sans-serif;
              }

              .form-control,
              .form-label,
              .input-group-text,
              .form-check-label {
                  font-size: 16px;
              }

              /* Chrome, Safari, Edge, Opera */
              input::-webkit-outer-spin-button,
              input::-webkit-inner-spin-button {
                  -webkit-appearance: none;
                  margin: 0;
              }

              /* Firefox */
              input[type=number] {
                  -moz-appearance: textfield;
              }

              .dot-spinner {
                  --uib-size: 2.8rem;
                  --uib-speed: .9s;
                  --uib-color: #183153;
                  position: relative;
                  display: flex;
                  align-items: center;
                  justify-content: flex-start;
                  height: var(--uib-size);
                  width: var(--uib-size);
              }

              .dot-spinner__dot {
                  position: absolute;
                  top: 0;
                  left: 0;
                  display: flex;
                  align-items: center;
                  justify-content: flex-start;
                  height: 100%;
                  width: 100%;
              }

              .dot-spinner__dot::before {
                  content: '';
                  height: 20%;
                  width: 20%;
                  border-radius: 50%;
                  background-color: var(--uib-color);
                  transform: scale(0);
                  opacity: 0.5;
                  animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
                  box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
              }

              .dot-spinner__dot:nth-child(2) {
                  transform: rotate(45deg);
              }

              .dot-spinner__dot:nth-child(2)::before {
                  animation-delay: calc(var(--uib-speed) * -0.875);
              }

              .dot-spinner__dot:nth-child(3) {
                  transform: rotate(90deg);
              }

              .dot-spinner__dot:nth-child(3)::before {
                  animation-delay: calc(var(--uib-speed) * -0.75);
              }

              .dot-spinner__dot:nth-child(4) {
                  transform: rotate(135deg);
              }

              .dot-spinner__dot:nth-child(4)::before {
                  animation-delay: calc(var(--uib-speed) * -0.625);
              }

              .dot-spinner__dot:nth-child(5) {
                  transform: rotate(180deg);
              }

              .dot-spinner__dot:nth-child(5)::before {
                  animation-delay: calc(var(--uib-speed) * -0.5);
              }

              .dot-spinner__dot:nth-child(6) {
                  transform: rotate(225deg);
              }

              .dot-spinner__dot:nth-child(6)::before {
                  animation-delay: calc(var(--uib-speed) * -0.375);
              }

              .dot-spinner__dot:nth-child(7) {
                  transform: rotate(270deg);
              }

              .dot-spinner__dot:nth-child(7)::before {
                  animation-delay: calc(var(--uib-speed) * -0.25);
              }

              .dot-spinner__dot:nth-child(8) {
                  transform: rotate(315deg);
              }

              .dot-spinner__dot:nth-child(8)::before {
                  animation-delay: calc(var(--uib-speed) * -0.125);
              }

              @keyframes pulse0112 {

                  0%,
                  100% {
                      transform: scale(0);
                      opacity: 0.5;
                  }

                  50% {
                      transform: scale(1);
                      opacity: 1;
                  }
              }
          </style>
      </head>

      <body>
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background-color: #2706F0;">
              <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" id="hamburger">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar">
                      <a class="navbar-brand" href="#">
                          <img src="/ATS/ATSPROD_PORTAL/assets/images/ATS logoa.png" alt="Logo" width="70" height="40" class="rounded">
                      </a>
                      <ul class="navbar-nav me-1 mb-2 mb-lg-0">
                          <?php if ($Role === "Approver 1" || $Role === "Approver 2" || $Role === "Approver 3") { ?>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="bc_dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                              </li>
                              <?php if ($Role === "Approver 1" || $Role === "Approver 2") { ?>
                                  <li class="nav-item">
                                      <a class="nav-link active text-white" aria-current="page" href="qbom.php"><i class="fa-solid fa-folder-open"></i> QBOM List</a>
                                  </li>
                                  <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle text-white" href="#" data-mdb-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sliders"></i> Updater</a>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" aria-current="page" href="upload_qboms.php"><i class="fa-regular fa-rectangle-list"></i> Update QBOMS</a></li>
                                          <li> <a class="dropdown-item" aria-current="page" href="upload_bu_list.php"><i class="fa-regular fa-rectangle-list"></i> Update BU List</a></li>
                                      </ul>
                                  </li>
                              <?php } ?>
                          <?php } elseif ($Role === "Requestor") { ?>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="pur_dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link text-white" href="bc_requestor.php"><i class="fa-solid fa-file-lines"></i> PPV Request</a>
                              </li>
                          <?php } elseif ($Role === "Optional Approver") { ?>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="sor_dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                              </li>
                          <?php } else { ?>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="bc_dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Approver Dashboard</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="pur_dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Requestor Dashboard</a>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle text-white" href="#" data-mdb-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-file-lines"></i> PPV</a>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" aria-current="page" href="bc_requestor.php"><i class="fa-regular fa-file-lines"></i> PPV Request</a></li>
                                      <li><a class="dropdown-item" aria-current="page" href="ppv_files.php"><i class="fa-regular fa-circle-down"></i> PPV Files</a></li>
                                  </ul>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link active text-white" aria-current="page" href="qbom.php"><i class="fa-solid fa-folder-open"></i> QBOM List</a>
                              </li>
                              <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle text-white" href="#" data-mdb-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-sliders"></i> Updater</a>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" aria-current="page" href="upload_qboms.php"><i class="fa-regular fa-rectangle-list"></i> Update QBOMS</a></li>
                                      <li> <a class="dropdown-item" aria-current="page" href="upload_bu_list.php"><i class="fa-regular fa-rectangle-list"></i> Update BU List</a></li>
                                  </ul>
                              </li>
                          <?php } ?>
                      </ul>
                  </div>
                  <div class="d-flex align-items-center">
                      <!-- Notifications -->
                      <!-- <div class="dropdown">
                          <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="notif" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-bell"></i>
                              <span class="badge rounded-pill badge-notification bg-danger">1</span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notif">
                              <li>
                                  <a class="dropdown-item" href="#">Some news</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="#">Another news</a>
                              </li>
                              <li>
                                  <a class="dropdown-item" href="#">Something else here</a>
                              </li>
                          </ul>
                      </div> -->
                      <!-- Avatar-->
                      <div class="dropdown">
                          <div class="d-flex align-items-end link-body-emphasis hidden-arrow dropdown-toggle text-white" data-mdb-toggle="dropdown" data-mdb-display="static" aria-expanded="false" type="button">
                              <a href="#" class="">
                                  <img src="../assets/images/user.png" alt="Profile" width="42" height="42" class="rounded-circle">
                              </a>
                              <h6 class="my-auto ms-2 d-none d-sm-block"><?php echo $Name; ?></h6>
                          </div>
                          <ul class="dropdown-menu dropdown-menu-end" id="profileDropdown">
                              <li class="dropdown-item text-bg-primary fw-bold d-sm-block d-md-none d-lg-none d-xl-none"><?php echo $Name; ?></li>
                              <li><a class="dropdown-item " href="bc_profile.php"><i class="fa-regular fa-circle-user"></i> Profile</a></li>
                              <?php if ($Position === "Admin") { ?>

                                  <li><a class="dropdown-item" href="bc_add_user.php"><i class="fa-solid fa-plus"></i> Add User</a></li>
                              <?php  } ?>
                              <!-- <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Settings</a></li> -->
                              <li>
                                  <hr class="dropdown-divider">
                              </li>
                              <li><a class="dropdown-item" onclick="logoutAlert()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log out</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </nav>

          <script>
              function logoutAlert() {
                  Swal.fire({
                      title: "Are you sure?",
                      text: "You will be logged out!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: "Logout",
                      cancelButtonText: "Cancel",
                  }).then((result) => {
                      if (result.value) {
                          window.location.href = "../controllers/logout.php";
                      }
                  });
              }
              $(document).ready(function() {
                  $('.form-outline').each(function() {
                      new mdb.Input(this).init();
                  });
                  // Get references to the navbar-toggler button and the profile dropdown menu
                  const navbarToggler = $('#hamburger');
                  const profileDropdown = $('#profileDropdown');

                  // Add a click event handler to the navbar-toggler button
                  navbarToggler.on('click', function() {
                      // Toggle the classes based on the button's state
                      if (profileDropdown.hasClass('dropdown-menu-end')) {
                          profileDropdown.removeClass('dropdown-menu-end').addClass('dropdown-menu-start');
                      } else {
                          profileDropdown.removeClass('dropdown-menu-start').addClass('dropdown-menu-end');
                      }
                  });
              });
          </script>
      </body>
  <?php } ?>