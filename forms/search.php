<?php
// forms/search.php
require_once './../includes/connect/beta.php';

// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Create an instance of Trvpsearch class with the database connection
$trvpSearch = new Trvpsearch($link);

try {
    if (isset($_REQUEST["term"])) {
        $term = $_REQUEST["term"];

        // Define a list of specific terms and their corresponding column names
        $specificTerms = ['dit', 'bit', 'dcs', 'bcs', 'dic', 'bic', 'bstat', 'dstat'];
        $column = '';

        // Check if the term matches any of the specific terms
        if (in_array($term, $specificTerms)) {
            $column = $term;
        }

        // Check if user is logged in using the isLoggedIn method from Trvpsearch class
        if ($trvpSearch->isLoggedIn()) {
            if ($column) {
                // User is logged in and searching for a specific term
                $sql = "
                    SELECT DISTINCT c.course_id, c.course_code, c.course_title, c.year, c.semester, l.l_name, l.mobile, l.l_avatar, r.grade, r.status 
                    FROM courses c
                    JOIN course_results r ON c.course_code = r.course_code
                    JOIN lecturers l ON c.l_code = l.l_code
                    WHERE c.$column = 'Yes' AND r.regNo = :regNo";
                
                $stmt = $link->prepare($sql);
                $regNo = $_SESSION['regNo'];  // Assuming regNo is stored in session

                // Bind parameters to statement
                $stmt->bindParam(":regNo", $regNo);
            } else {
                // User is logged in and searching for other terms
                $term = $term . '%';
                $sql = "
                    SELECT DISTINCT c.course_id, c.course_code, c.course_title, c.year, c.semester, l.l_name, l.mobile, l.l_avatar, r.grade, r.status 
                    FROM courses c
                    JOIN course_results r ON c.course_code = r.course_code
                    JOIN lecturers l ON c.l_code = l.l_code
                    WHERE c.course_title LIKE :term AND r.regNo = :regNo";
                
                $stmt = $link->prepare($sql);
                $regNo = $_SESSION['regNo'];  // Assuming regNo is stored in session

                // Bind parameters to statement
                $stmt->bindParam(":term", $term);
                $stmt->bindParam(":regNo", $regNo);
            }
        } else {
            if ($column) {
                // User is not logged in and searching for a specific term
                $sql = "
                    SELECT DISTINCT c.course_id, c.course_code, c.course_title, c.year, c.semester, l.l_name, l.mobile, l.l_avatar
                    FROM courses c
                    JOIN lecturers l ON c.l_code = l.l_code
                    WHERE c.$column = 'Yes'";
                $stmt = $link->prepare($sql);
            } else {
                // User is not logged in and searching for other terms
                $term = $term . '%';
                $sql = "
                    SELECT DISTINCT c.course_id, c.course_code, c.course_title, c.year, c.semester, l.l_name, l.mobile, l.l_avatar
                    FROM courses c
                    JOIN lecturers l ON c.l_code = l.l_code
                    WHERE c.course_title LIKE :term";
                $stmt = $link->prepare($sql);
                
                // Bind parameters to statement
                $stmt->bindParam(":term", $term);
            }
        }

        // Execute the prepared statement
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            // Start table
            echo '<div id="search-results" style="max-height: 325px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0 bg-white">
                      <thead class="bg-light">
                        <tr>
                          <th>Lecturer</th>
                          <th>Course Unit</th>
                          <th>Year</th>
                          <th>Semester</th>';
            if ($trvpSearch->isLoggedIn()) {
                echo '<th>Grade</th>
                      <th>Status</th>';
            }
            echo '</tr></thead><tbody>';

            // Fetch rows
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                        <td style="padding: 0.5rem 1rem;">
                          <div class="d-flex align-items-center">
                            <img src="images/' . htmlspecialchars($row["l_avatar"]) . '" style="width: 35px; height: 35px; filter: blur(5px);" class="rounded-circle" />
                            <div class="ms-3">
                              <p class="fw-bold mb-1">' . htmlspecialchars($row["l_name"]) . '</p>
                              <p class="text-muted mb-0">' . htmlspecialchars($row["mobile"]) . '</p>
                            </div>
                          </div>
                        </td>
                        <td style="padding: 0.5rem 1rem;">
                          <p class="fw-normal mb-1">' . htmlspecialchars($row["course_title"]) . '</p>
                          <p class="text-muted mb-0">' . htmlspecialchars($row["course_code"]) . '</p>
                        </td>
                        <td style="padding: 0.5rem 1rem;">' . htmlspecialchars($row["year"]) . '</td>
                        <td style="padding: 0.5rem 1rem;">' . htmlspecialchars($row["semester"]) . '</td>';
                if ($trvpSearch->isLoggedIn()) {
                    $badgeClass = '';
                    switch ($row["status"]) {
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
                            $badgeClass = '';
                            break;
                    }
                    echo '<td style="padding: 0.5rem 1rem;">' . htmlspecialchars($row["grade"]) . '</td>
                          <td style="padding: 0.5rem 1rem;"><span class="badge rounded-pill d-inline ' . $badgeClass . '">' . htmlspecialchars($row["status"]) . '</span></td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table></div>';
        } else {
            echo "<p>No matches found</p>";
        }
    }
} catch (PDOException $e) {
    die("ERROR: Could not execute $sql. " . $e->getMessage());
}
?>
