<?php
// Initialize the session
include('includes/connect/alpha.php');

@$studentId = $_SESSION['studentId'];
$regNo = $_SESSION['regNo'];
$email = $_SESSION['email'];

$errors = [];
$data = [];
$get = new Trvpsearch($link);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Trvp Search</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body>
  <!--Main Navigation-->
  <style>
    /* Default height for small devices */
    #intro {
      height: 600px;
      /* Margin to fix overlapping fixed navbar */
      margin-top: 58px;
    }

    @media (max-width: 991px) {
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 45px;
      }
    }
  </style>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <!-- Navbar brand -->
      <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link text-dark" aria-current="page" href="#">
              <b>TRVP SEARCH</b>
              <?php echo $_SESSION['studentId']; ?>
            </a>
          </li>
        </ul>
        <!-- displayNavigationBar -->
        <?php $get->displayNavigationBar(); ?>
      </div>
    </div>
  </nav>

  <!-- trvp search -->
  <div id="intro" class="p-5 text-center bg-image shadow-1-strong" style="background-image: url('images/trvpbg.jpeg');">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white px-4" data-mdb-theme="dark">
          <h1 class="mb-4">Trvp Search</h1>
          <form id="search-form">
            <div class="form-outline mb-2" data-mdb-input-init>
              <input type="search" class="form-control" id="search-input" style="min-width: 30rem;">
              <label class="form-label" for="search-input">Search</label>
            </div>
          </form>
          <div id="datatable" style="max-height: 325px; overflow-y: auto;">
          <table class="table table-hover align-middle mb-0 bg-white">
              <thead class="bg-light">
                <tr>
                  <th>Lecturer</th>
                  <th>Course Unit</th>
                  <th>Semester</th>
                  <th>Result</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="padding: 0.5rem 1rem;">
                    <div class="d-flex align-items-center">
                      <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 35px; height: 35px" class="rounded-circle" />
                      <div class="ms-3">
                        <p class="fw-bold mb-1">Ms. Nuwagaba Lehema</p>
                        <p class="text-muted mb-0"> 077 840 829</p>
                      </div>
                    </div>
                  </td>
                  <td style="padding: 0.5rem 1rem;">
                    <p class="fw-normal mb-1">English Language Skills</p>
                    <p class="text-muted mb-0">UCC1101</p>
                  </td>
                  <td style="padding: 0.5rem 1rem;"> 1:1</td>
                  <td style="padding: 0.5rem 1rem;">B+</td>
                  <td style="padding: 0.5rem 1rem;">
                    <span class="badge badge-success rounded-pill d-inline">Finished</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="mt-3"> Simply search that course unit!! </p>
        </div>
      </div>
    </div>
  </div>

  <!-- signup -->
  <div class="py-5 px-md-1 text-center text-lg-start">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            First 👉 <br />
            <span class="text-primary">Sign up here</span>
          </h1>
          <div class="row" style="text-align: justify;">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <p class="card-text">Introducing an <b>ultimate tool</b> to effortlessly search and discover <span class="text-primary"><u>courses</u></span></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <p class="card-text"><span class="text-primary">Join</span> to unlock <b>customized</b> search
                    features tailored to your unique preferences.</p>
                </div>
              </div>
            </div>
          </div>
          <!-- <p style="color: hsl(217, 10%, 50.8%);text-align: justify;">
            Your ultimate tool to effortlessly search and discover courses that match your academic interests and requirements.

            Sign up today to unlock customized search features tailored to your unique preferences and academic goals. 
            Make your course selection process simple and efficient with <b>Trvp Search</b>.
          </p> -->
        </div>
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form id="createaccount">
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <select data-mdb-select-init class="form-select form-select-sm" id="school" name="school">
                        <option value="somac">SOMAC</option>
                        <option value="sonas">SONAS</option>
                        <option value="economics">ECONOMICS</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <select data-mdb-select-init class="form-select form-select-sm" id="programme" name="programme">
                        <option value="dit">DIT</option>
                        <option value="bit">BIT</option>
                        <option value="dcs">DCS</option>
                        <option value="bcs">BCS</option>
                        <option value="dic">DIC</option>
                        <option value="bic">BIC</option>
                        <option value="dstart">DSTAT</option>
                        <option value="bstart">BSTAT</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- Full name -->
                  <div class="col">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="fullname" name="fullname" class="form-control " autocomplete="off" value="hello M" />
                      <label class="form-label" for="fullname">Full name</label>
                    </div>
                    <div id="fullnameErr" class="mt-n2"></div>
                  </div>
                  <!-- Registration Number -->
                  <div class="col">
                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="regNo" name="regNo" class="form-control" autocomplete="off" value="2034-08-34221" />
                      <label class="form-label" for="regNo">Registration Number</label>
                    </div>
                    <div id="regNoErr" class="mt-n2"></div>
                  </div>
                </div>
                <div class="mt-4 mb-3">
                  <!-- Email -->
                  <div data-mdb-input-init class="form-outline">
                    <input type="email" id="email" name="email" class="form-control " autocomplete="off" value="hello@gmail.com" />
                    <label class="form-label" for="emailaddress">Email address </label>
                  </div>
                  <div id="emailErr" class="mt-n2"></div>
                </div>
                <div class="mt-4 mb-3">
                  <!-- password -->
                  <div data-mdb-input-init class="form-outline">
                    <input type="password" id="password" name="password" class="form-control " autocomplete="off" value="hellogmail" />
                    <label class="form-label" for="password">Password </label>
                  </div>
                  <div id="passwordErr" class="mt-n2"></div>
                </div>
                <!-- Tos -->
                <div class="form-check d-flex justify-content-center mt-4 mb-4">
                  <input class="form-check-input me-2" type="checkbox" id="tos" />
                  <label class="form-check-label" for="tos">
                    <span class="text-primary"> I am a KIU student </span>
                  </label>
                </div>
                <!-- Submit button -->
                <div id="afterSignup" class="d-flex justify-content-center">
                  <button data-mdb-ripple-init type="submit" id="signup" class="btn btn-primary btn-block mb-4">
                    Sign up <strong id="signupLoading"></strong>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <hr class="m-0" />
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 <a class="text-reset fw-bold" href="#">trvpsearch.ac.org</a>
    </div>
  </footer>

  <!-- MDB -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="js/mdb.umd.min.js"></script>
  <script src="js/script.js"></script>

</body>

</html>