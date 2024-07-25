<?php
// user.php
class Trvpsearch
{
    private $_link;

    function __construct($link)
    {
        $this->_link = $link;
    }
    public function check_email($email)
    {
        if (!$this->_link) {
            error_log('Database connection not found in getStudentByEmail');
            return ['success' => false, 'message' => 'Database connection not found'];
        }
        try {
            $stmt = $this->_link->prepare('SELECT * FROM students WHERE email = :email AND activation = "Yes"');
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return ['success' => false, 'message' => 'Email already exists'];
            } else {
                return ['success' => true, 'data' => null];
            }
        } catch (PDOException $e) {
            error_log('Error: check_email: ' . $e->getMessage()); // log the full error message
            return ['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]; // return the exact error message

        }
    }
    public function check_regNo($regNo)
    {
        if (!$this->_link) {
            error_log('Database connection not found in check_regNo');
            return ['success' => false, 'message' => 'Database connection not found'];
        }
        try {
            $stmt = $this->_link->prepare('SELECT * FROM students WHERE regNo = :regNo AND activation = "Yes"');
            $stmt->bindParam(":regNo", $regNo, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return ['success' => false, 'message' => 'Registration number already exists'];
            } else {
                return ['success' => true, 'data' => null];
            }
        } catch (PDOException $e) {
            error_log('Error: check_regNo: ' . $e->getMessage()); // log the full error message
            return ['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]; // return the exact error message
        }
    }
    public function getStudent()
    {
        if (!$this->_link) {
            error_log('Database connection not found in getStudent');
            return false;
        }

        $email = $_SESSION['email'];

        try {
            $stmt = $this->_link->prepare('SELECT * FROM students WHERE email = :email AND activation = "Yes"');
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('Error: getStudent: ' . $e->getMessage());
            return false;
        }
    }

    public function isValidSchool($school)
    {
        if (strlen($school) < 1) {
            return ['success' => false, 'message' => '<b>Please!!</b> enter your school'];
        }
        if (!in_array(strtolower($school), ['somac', 'sonas', 'economics'])) {
            return ['success' => false, 'message' => 'Invalid school'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function isValidProgramme($programme)
    {
        if (strlen($programme) < 1) {
            return ['success' => false, 'message' => '<b>Please!!</b> enter your programme'];
        }
        if (!in_array(strtolower($programme), ['dit', 'bit', 'dcs', 'bcs', 'dic', 'bic', 'dstat', 'bstat'])) {
            return ['success' => false, 'message' => 'Invalid programme'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function isValidFullname($fullname)
    {
        if (empty($fullname)) {
            return ['success' => false, 'message' => 'What is your name?'];
        }
        if (strlen($fullname) < 3 || strlen($fullname) > 35 || strpos($fullname, ' ') === false) {
            return ['success' => false, 'message' => 'Invalid Full name'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function isValidRegNo($regNo)
    {
        if (empty($regNo)) {
            return ['success' => false, 'message' => '<b>Please..</b> enter your registration number'];
        }
        if (!(strlen($regNo) === 13 && preg_match('/^20[0-9]{2}-[0-9]{2}-[0-9]{5}$/', $regNo))) {
            return ['success' => false, 'message' => 'Wrong registration number'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function isValidEmail($email)
    {
        if (empty($email)) {
            return ['success' => false, 'message' => 'Please.. enter your email'];
        }
        if (strlen($email) < 5 || strlen($email) > 50) {
            return ['success' => false, 'message' => 'Invalid Email'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => '<b>Please..</b> enter a valid email'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function isValidPassword($password)
    {
        if (empty($password)) {
            return ['success' => false, 'message' => 'Please.. enter a password'];
        }
        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }
        if (strlen($password) > 255) {
            return ['success' => false, 'message' => 'Password must not exceed 255 characters'];
        }
        return ['success' => true, 'message' => ''];
    }
    public function createStudent($school, $programme, $fullname, $regNo, $email, $password): array
    {
        try {
            $this->_link->beginTransaction();
            $this->_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Validate input data
            if (empty($school) || empty($programme) || empty($email) || empty($regNo) || empty($password) || empty($fullname)) {
                throw new InvalidArgumentException('Invalid input data');
            }

            // Hash the password (password_hash automatically handles the salt)
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Create the student
            $stmt = $this->_link->prepare('INSERT INTO students (school, programme, fullname, regNo, email, password) VALUES (:school, :programme, :fullname, :regNo, :email, :password)');
            $stmt->bindParam(":school", $school, PDO::PARAM_STR);
            $stmt->bindParam(":programme", $programme, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
            $stmt->bindParam(":regNo", $regNo, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();

                if ($rowCount == 1) {
                    $this->_link->commit();

                    // Log the user in after successful sign-up
                    $this->loginWithEmail($email, $password);

                    return ['success' => true, 'message' => 'Account created successfully!'];
                } else {
                    $this->_link->rollBack();
                    throw new RuntimeException('Failed to create account');
                }
            } else {
                $this->_link->rollBack();
                throw new RuntimeException('Failed to execute statement');
            }
        } catch (PDOException $e) {
            $this->_link->rollBack();
            error_log('Error in createStudent: ' . $e->getMessage() . ' (Error code: ' . $e->getCode() . ')');
            throw new RuntimeException('Database error: ' . $e->getMessage() . ' (Error code: ' . $e->getCode() . ')', 0, $e);
        }
    }
    public function loginWithEmail($email, $password)
    {
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Inputs cannot be empty'];
        }

        if (!$this->isValidEmail($email) || !$this->isValidPassword($password)) {
            return ['success' => false, 'message' => 'Invalid email / password'];
        }

        try {
            $stmt = $this->_link->prepare('SELECT * FROM students WHERE email = :email');
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!$row) {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }

            // Retrieve the stored password hash
            $hashedPassword = $row['password'];

            // Verify the input password against the stored hash
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['studentId'] = $row['studentId'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['fullname'] = $row['fullname'];
                return ['success' => true, 'message' => 'Login successful'];
            } else {
                return ['success' => false, 'message' => 'Login failed... Invalid email or password'];
            }
        } catch (PDOException $e) {
            error_log('Error in loginWithEmail: ' . $e->getMessage()); // log the full error message
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()]; // return the exact error message
        }
    }
    public function getLoggedInEmail()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            return $_SESSION['email'];
        }
    }
    public function isLoggedIn()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            return true;
        }
    }
    public function logout()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            session_destroy();
            unset($_SESSION['loggedin']);
            unset($_SESSION['studentId']);
            unset($_SESSION['email']);
            unset($_SESSION['fullname']);
            return true;
        }
    }

    public function displayNavigationBar()
    {
        if ($this->isLoggedIn()) {
            $email = $_SESSION['email'];
            //$user = $this->getStudentByEmail($email);
            $user = $this->getStudent();

            if ($user) {
                $fullname = $user['fullname'];
                $avatar = $user['avatar'];
                $programme = $user['programme'];

                // Break the full name and get the second name
                $names = explode(' ', $fullname);
                $firstName = $names[0];
                $secondName = isset($names[1]) ? $names[1] : '';
?>
                <div class="dropdown">
                    <a data-mdb-dropdown-init class="btn btn-success rounded-pill dropdown-toggle d-flex align-items-center hidden-arrow btn-sm" href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false" style="padding: 5px 10px">
                        <img src="images/avatar.jpg" class="rounded-circle" height="35" loading="lazy" />
                        <span class="ps-2" style="font-size: initial;"><?php echo $secondName; ?></span>
                        <span class="badge badge-warning ms-2"><?php echo $programme; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="status" checked />
                                    <label class="form-check-label" for="status"> Status </label>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="result" checked />
                                    <label class="form-check-label" for="result"> Result </label>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider my-0" />
                        </li>
                        <li class="text-center">
                            <a class="dropdown-item bg-danger text-white" href="logout"> <i class="fas fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            <?php
            }
        } else {
            ?>
            <ul class="navbar-nav d-flex flex-row">
                <form class="login">
                    <div class="row row-cols-lg-auto g-3 align-items-center">
                        <div class="data-inputs">
                            <div class="d-flex justify-content-between">
                                <div class="col" style="margin-right: 10px;">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="email" name="email" class="email form-control form-control-sm" />
                                        <label class="form-label" for="email">Email address</label>
                                    </div>
                                    <!-- <div class="emailErr mt-n2"></div> -->
                                </div>
                                <div class="col">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="password" name="password" class="password form-control form-control-sm" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <!-- <div class="passwordErr mt-n2"></div> -->
                                </div>
                            </div>
                            <div class="err d-block d-flex justify-content-center">
                                <div class="emailErr mt-n2" style="margin-right: 15px;"></div>
                                <div class="passwordErr mt-n2"></div>
                                <div class="loginErr mt-n2"></div>
                            </div>
                        </div>

                        <div>
                            <div class="col">
                                <button data-mdb-ripple-init type="submit" id="signin" name="signin" class="btn btn-outline-primary btn-sm">
                                    SIGN IN <strong id="afterSignin"> </strong>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- loginErr -->
                    <!-- <div class="loginErr text-center">  </div>
            <div id="afterSignin" class="text-center"></div> -->
                </form>
            </ul>
<?php
        }
    }
    public function search($options = array())
    {
        $options = $this->mergeDefaultOptions($options);
        $query_sql = $this->buildQuery();
        $conditions = $this->buildConditions($options);
        $query_sql = $this->appendConditionsToQuery($query_sql, $conditions);

        try {
            $result = $this->executeQuery($query_sql, $conditions['params']);
            return $this->formatResults($result);
        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            return json_encode(array('error' => 'Database query failed.'));
        }
    }
    private function mergeDefaultOptions($options)
    {
        $defaultOptions = array(
            'programme' => null,
            'year' => null,
            'semester' => null,
            'lecturer_code' => null,
            'lecturer_name' => null,
            'student_id' => null,
            'course_code' => null
        );
        return array_merge($defaultOptions, $options);
    }
    private function buildQuery()
    {
        return "SELECT s.fullname, s.regNo, s.programme, l.l_name, l.l_avatar, l.mobile, 
                   c.course_title, c.course_code, cr.grade, cr.cr_status, 
                   cr.result_id, cr.regNo AS studentRegNo
            FROM course_results cr
            INNER JOIN students s ON cr.regNo = s.regNo
            INNER JOIN course c ON cr.course_code = c.course_code
            INNER JOIN lecturers l ON c.l_code = l.l_code";
    }
    private function buildConditions($options)
    {
        $conditions = array();
        $params = array();

        if ($options['programme']) {
            $conditions[] = "s.programme = :programme";
            $params[':programme'] = $options['programme'];
        }

        if ($options['year'] && $options['semester']) {
            $conditions[] = "c.year = :year AND c.semester = :semester";
            $params[':year'] = $options['year'];
            $params[':semester'] = $options['semester'];
        }

        if ($options['lecturer_code']) {
            $conditions[] = "l.l_code = :lecturer_code";
            $params[':lecturer_code'] = $options['lecturer_code'];
        }

        if ($options['lecturer_name']) {
            $conditions[] = "l.l_name LIKE :lecturer_name";
            $params[':lecturer_name'] = "%{$options['lecturer_name']}%";
        }

        if ($options['student_id']) {
            $conditions[] = "s.studentId = :student_id";
            $params[':student_id'] = $options['student_id'];
        }

        if ($options['course_code']) {
            $conditions[] = "c.course_code = :course_code";
            $params[':course_code'] = $options['course_code'];
        }

        return array('conditions' => $conditions, 'params' => $params);
    }
    private function appendConditionsToQuery($query_sql, $conditions)
    {
        if (count($conditions['conditions']) > 0) {
            $query_sql .= " WHERE " . implode(" AND ", $conditions['conditions']);
        }
        return $query_sql;
    }
    private function executeQuery($query_sql, $params)
    {
        $stmt = $this->_link->prepare($query_sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function formatResults($result)
    {
        $data = array();
        $isLoggedIn = $this->isLoggedIn();

        foreach ($result as $row) {
            $entry = array(
                'student_name' => htmlspecialchars($row['fullname']),
                'student_regNo' => htmlspecialchars($row['studentRegNo']),
                'programme' => htmlspecialchars($row['programme']),
                'lecturer' => htmlspecialchars($row['l_name']),
                'lecturer_avatar' => htmlspecialchars($row['l_avatar']),
                'course_title' => htmlspecialchars($row['course_title']),
                'course_code' => htmlspecialchars($row['course_code']),
                'result_id' => htmlspecialchars($row['result_id'])
            );

            if ($isLoggedIn) {
                $entry['grade'] = htmlspecialchars($row['grade']);
                $entry['status'] = htmlspecialchars($row['cr_status']);
            }

            $data[] = $entry;
        }

        return json_encode($data);
    }
    
}

?>
