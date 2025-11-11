<?php
// results.php
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';
require_once 'includes/session.php';

// Check if user is logged in
if (!$user->isLoggedIn()) {
    header('Location: ./');
    exit;
}

$student = $user->getStudent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>My Results - Trvp Search</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="./">
        <b>TRVP SEARCH</b>
      </a>
      <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="results.php">My Results</a>
          </li>
        </ul>
        <!-- displayNavigationBar -->
        <?php $get->displayNavigationBar(); ?>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-5">
    <!-- Statistics Cards -->
    <?php 
    $stats = $user->getStudentStats();
    ?>
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-body">
            <h2 class="text-primary"><?php echo $stats['total']; ?></h2>
            <p class="mb-0">Total Courses</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-body">
            <h2 class="text-success"><?php echo $stats['passed']; ?></h2>
            <p class="mb-0">Passed</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-body">
            <h2 class="text-danger"><?php echo $stats['redo']; ?></h2>
            <p class="mb-0">Redo</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card text-center">
          <div class="card-body">
            <h2 class="text-warning"><?php echo $stats['tbd']; ?></h2>
            <p class="mb-0">Pending</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Results Table -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
              <i class="fas fa-graduation-cap"></i> My Course Results
            </h4>
            <small>
              <?php echo htmlspecialchars($student['fullname']); ?> - 
              <?php echo htmlspecialchars($student['regNo']); ?>
            </small>
          </div>
          <div class="card-body">
            <div id="datatable" style="max-height: 500px; overflow-y: auto;">
              <?php
              $results = $user->getStudentResults();
              
              if ($results && count($results) > 0) {
              ?>
                  <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="bg-light">
                      <tr>
                        <th>Lecturer</th>
                        <th>Course Unit</th>
                        <th>Year:Semester</th>
                        <th>Grade</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($results as $row) { 
                        // Determine badge class based on status
                        $badgeClass = '';
                        switch ($row['status']) {
                          case 'Passed':
                            $badgeClass = 'badge-success';
                            break;
                          case 'Redo':
                            $badgeClass = 'badge-danger';
                            break;
                          case 'TBD':
                            $badgeClass = 'badge-warning';
                            break;
                          default:
                            $badgeClass = 'badge-secondary';
                            break;
                        }
                      ?>
                        <tr>
                          <td style="padding: 0.5rem 1rem;">
                            <div class="d-flex align-items-center">
                              <img 
                                src="images/<?php echo htmlspecialchars($row['l_avatar']); ?>" 
                                alt="Lecturer Avatar" 
                                style="width: 35px; height: 35px; filter: blur(5px);" 
                                class="rounded-circle" 
                                onerror="this.src='images/avatar.jpg'"
                              />
                              <div class="ms-3">
                                <p class="fw-bold mb-1"><?php echo htmlspecialchars($row['l_name']); ?></p>
                                <p class="text-muted mb-0"><?php echo htmlspecialchars($row['mobile']); ?></p>
                              </div>
                            </div>
                          </td>
                          <td style="padding: 0.5rem 1rem;">
                            <p class="fw-normal mb-1"><?php echo htmlspecialchars($row['course_title']); ?></p>
                            <p class="text-muted mb-0"><?php echo htmlspecialchars($row['course_code']); ?></p>
                          </td>
                          <td style="padding: 0.5rem 1rem;">
                            <?php echo htmlspecialchars($row['year']) . ':' . htmlspecialchars($row['semester']); ?>
                          </td>
                          <td style="padding: 0.5rem 1rem;">
                            <strong><?php echo htmlspecialchars($row['grade']); ?></strong>
                          </td>
                          <td style="padding: 0.5rem 1rem;">
                            <span class="badge <?php echo $badgeClass; ?> rounded-pill d-inline">
                              <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              <?php
              } else {
                echo '<div class="alert alert-info text-center" role="alert">
                        <i class="fas fa-info-circle"></i> No course results found. 
                        Please contact your administrator.
                      </div>';
              }
              ?>
            </div>
          </div>
          <div class="card-footer text-muted">
            <div class="row">
              <div class="col-md-6">
                <small><i class="fas fa-info-circle"></i> Total Courses: 
                  <strong><?php echo count($results ?: []); ?></strong>
                </small>
              </div>
              <div class="col-md-6 text-end">
                <button class="btn btn-sm btn-primary" onclick="window.print()">
                  <i class="fas fa-print"></i> Print Results
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-light text-lg-start mt-5">
    <hr class="m-0" />
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2024 <a class="text-reset fw-bold" href="#">trvpsearch.ac.org</a>
    </div>
  </footer>

  <!-- MDB -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="js/mdb.umd.min.js"></script>
</body>
</html>