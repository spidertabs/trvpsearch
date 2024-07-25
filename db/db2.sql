SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE students (
  studentId INT NOT NULL AUTO_INCREMENT,
  phoneNumber INT,
  avatar VARCHAR(255),
  fullname VARCHAR(255) NOT NULL,
  sex ENUM('Male','Female','NA') DEFAULT 'NA' NOT NULL,
  regNo VARCHAR(255) NOT NULL,
  school ENUM('somac','sonas','economics') NOT NULL,
  programme ENUM('dit','bit','dcs','bcs','dic','bic','bstat','dstat') NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  activation ENUM('Yes','No') DEFAULT 'Yes' NOT NULL,
  dateJoined DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (studentId)
);

CREATE TABLE lecturers (
  lecturer_id INT NOT NULL AUTO_INCREMENT UNIQUE,
  l_code int not null,
  l_avatar varchar(255),
  l_name varchar(255),
  gender enum('Male','Female')  not null,
  mobile int not null,
  primary key (lecturer_id)
);

CREATE TABLE course (
  course_id INT NOT NULL AUTO_INCREMENT UNIQUE,
  l_code varchar(255),
  course_code varchar(255),
  course_title varchar(255),
  DIT ENUM('Yes', 'No') NOT NULL,
  BIT ENUM('Yes', 'No') NOT NULL,
  DCS ENUM('Yes', 'No') NOT NULL,
  BCS ENUM('Yes', 'No') NOT NULL,
  BIC ENUM('Yes', 'No') NOT NULL,
  DIC ENUM('Yes', 'No') NOT NULL,
  DSTAT ENUM('Yes', 'No') NOT NULL,
  BSTAT ENUM('Yes', 'No') NOT NULL,
  year ENUM('1', '2', '3', '4') NOT NULL,
  semester ENUM('1', '2') NOT NULL,
  primary key (course_id)
);

CREATE TABLE course_results (
  result_id INT NOT NULL AUTO_INCREMENT UNIQUE,
  regNo int not null,
  course_code int not null,
  grade ENUM('A', 'B+', 'B-', 'C+', 'C-', 'D+', 'D-', 'F') NOT NULL,
  cr_status ENUM('NA','Passed', 'TBD', 'Redo') NOT NULL,
  primary key (result_id)
);

INSERT INTO students (phoneNumber, avatar, fullname, sex, regNo, school, programme, email, password, salt, activation) VALUES
(0712345678, 'avatar1.jpg', 'Kofi Owusu', 'Male', '2022-08-22245', 'somac', 'dit', 'kofiowusu@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt1', 'Yes'),
(0723456789, 'avatar2.jpg', 'Nneoma Okoro', 'Female', '2022-08-22246', 'somac', 'dit', 'nneomaokoro@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt2', 'Yes'),
(0734567890, 'avatar3.jpg', 'Abdulai Jalloh', 'Male', '2022-08-22247', 'somac', 'bit', 'abdulaijalloh@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt3', 'Yes'),
(0745678901, 'avatar4.jpg', 'Akua Asante', 'Female', '2022-08-22248', 'somac', 'bit', 'akuasante@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt4', 'Yes'),

(0756789012, 'avatar5.jpg', 'Tunde Ogunbiyi', 'Male', '2022-08-22249', 'somac', 'dcs', 'tundeogunbiyi@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt5', 'Yes'),
(0767890123, 'avatar6.jpg', 'Nadia Sow', 'Female', '2022-08-22250', 'somac', 'dcs', 'nadiasow@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt6', 'Yes'),
(0734567890, 'avatar13.jpg', 'Nana Yaa Amponsah', 'Female', '2022-08-22257', 'somac', 'bcs', 'nanayaamponsah@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt7', 'Yes'),
(0745678901, 'avatar14.jpg', 'Kofi Agyapong', 'Male', '2022-08-22258', 'somac', 'bcs', 'kofiagyapong@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt8', 'Yes'),

(0778901234, 'avatar7.jpg', 'Kwame Boateng', 'Male', '2022-08-22251', 'sonas', 'dic', 'kwameboateng@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt9', 'Yes'),
(0789012345, 'avatar8.jpg', 'Fatoumata Diallo', 'Female', '2022-08-22252', 'sonas', 'dic', 'fatoumatadiallo@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'salt10', 'Yes'),
(0712345678, 'avatar11.jpg', 'Oluwaseun Adeyemi', 'Male', '2022-08-22255', 'onas', 'bic', 'oluwaseunadeyemi@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt11', 'Yes'),
(0723456789, 'avatar12.jpg', 'Aisha Mohammed', 'Female', '2022-08-22256', 'onas', 'bic', 'aishamohammed@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt12', 'Yes'),

(0790123456, 'avatar9.jpg', 'Emmanuel Mensah', 'Male', '2022-08-22253', 'economics', 'dstat', 'emmanuelmensah@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt13', 'Yes'),
(0701234567, 'avatar10.jpg', 'Yaa Agyeman', 'Female', '2022-08-22254', 'economics', 'dstat', 'yaaagyeman@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt14', 'Yes'),
(0756789012, 'avatar15.jpg', 'Fatima Jallow', 'Female', '2022-08-22259', 'economics', 'bstat', 'fatimajallow@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt15', 'Yes'),
(0767890123, 'avatar16.jpg', 'Ebenezer Osei', 'Male', '2022-08-22260', 'economics', 'bstat', 'ebenezerosei@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'alt16', 'Yes');



INSERT INTO lecturers (l_code, l_avatar, l_name, gender, mobile) VALUES
(101, 'avatar1.jpg', 'Dr. Kwame Owusu', 'Male', 0712345678),
(102, 'avatar2.jpg', 'Dr. Nneoma Okoro', 'Female', 0723456789),
(103, 'avatar3.jpg', 'Dr. Abdulai Jalloh', 'Male', 0734567890),
(104, 'avatar4.jpg', 'Dr. Akua Asante', 'Female', 0745678901),
(105, 'avatar5.jpg', 'Dr. Tunde Ogunbiyi', 'Male', 0756789012),
(106, 'avatar6.jpg', 'Dr. Nadia Sow', 'Female', 0767890123),
(107, 'avatar7.jpg', 'Dr. Kwame Boateng', 'Male', 0778901234),
(108, 'avatar8.jpg', 'Dr. Fatoumata Diallo', 'Female', 0789012345),
(109, 'avatar9.jpg', 'Dr. Emmanuel Mensah', 'Male', 0790123456),
(110, 'avatar10.jpg', 'Dr. Yaa Agyeman', 'Female', 0701234567),
(111, 'avatar11.jpg', 'Dr. Oluwaseun Adeyemi', 'Male', 0712345678),
(112, 'avatar12.jpg', 'Dr. Aisha Mohammed', 'Female', 0723456789),
(113, 'avatar13.jpg', 'Dr. Nana Yaa Amponsah', 'Female', 0734567890),
(114, 'avatar14.jpg', 'Dr. Kofi Agyapong', 'Male', 0745678901),
(115, 'avatar15.jpg', 'Dr. Fatima Jallow', 'Female', 0756789012),
(116, 'avatar16.jpg', 'Dr. Ebenezer Osei', 'Male', 0767890123),
(117, 'avatar17.jpg', 'Dr. Ama Appiah', 'Female', 0778901234),
(118, 'avatar18.jpg', 'Dr. Kwabena Danso', 'Male', 0789012345),
(119, 'avatar19.jpg', 'Dr. Abigail Mensah', 'Female', 0790123456),
(120, 'avatar20.jpg', 'Dr. Samuel Owusu', 'Male', 0701234567),
(121, 'avatar21.jpg', 'Dr. Hannah Asante', 'Female', 0712345678),
(122, 'avatar22.jpg', 'Dr. Michael Agyemang', 'Male', 0723456789),
(123, 'avatar23.jpg', 'Dr. Emmanuela Osei', 'Female', 0734567890),
(124, 'avatar24.jpg', 'Dr. Richard Boateng', 'Male', 0745678901),
(125, 'avatar25.jpg', 'Dr. Patricia Appiah', 'Female', 0756789012),
(126, 'avatar26.jpg', 'Dr. Daniel Ofori', 'Male', 0767890123),
(127, 'avatar27.jpg', 'Dr. Sophia Amoako', 'Female', 0778901234),
(128, 'avatar28.jpg', 'Dr. Joseph Mensah', 'Male', 0789012345),
(129, 'avatar29.jpg', 'Dr. Rachel Osei', 'Female', 0790123456),
(130, 'avatar30.jpg', 'Dr. Christopher Owusu', 'Male', 0701234567),
(131, 'avatar31.jpg', 'Dr. Georgina Asante', 'Female', 0712345678),
(132, 'avatar32.jpg', 'Dr. Benjamin Agyemang', 'Male', 0723456789),
(133, 'avatar33.jpg', 'Dr. Evelyn Osei', 'Female', 0734567890),
(134, 'avatar34.jpg', 'Dr. Francis Boateng', 'Male', 0745678901),
(135, 'avatar35.jpg', 'Dr. Diana Appiah', 'Female', 0756789012),
(136, 'avatar36.jpg', 'Dr. Gabriel Ofori', 'Male', 0767890123);


INSERT INTO course (l_code, course_code, course_title, DIT, BIT, DCS, BCS, BIC, DIC, DSTAT, BSTAT, year, semester) VALUES
('101', 'UCC1101', 'English Language Skills', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '1', '1'),
('102', 'UCC1100', 'Computer Fundamentals', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '1'),
('103', 'ITE1102', 'Introduction to Information Technology', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '1'),
('104', 'ITE1103', 'Mathematical Techniques For IS/IT', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '1'),
('105', 'IFS1111', 'Fundamentals of Information Technology', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '1'),
('106', 'HRM1101', 'Principles and Practice of Management', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', '1', '1'),

('107', 'UCC1201', 'Communication Skills', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '1', '2'),
('108', 'COS1211', 'Fundamentals of Programming', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '2'),
('109', 'ITE1203', 'Internet Technologies and Web Design', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '2'),
('111', 'ITE1204', 'Network Fundamentals', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '2'),
('112', 'ITE1202', 'Electronic Commerce', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '1', '2'),
('110', 'STA2105', 'Introduction to Probability and Statistics', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'No', '1', '2'),


('113', 'COS2211', 'Data Structures and Algorithms', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('114', 'ITE2201', 'Database Systems', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('115', 'ITE2202', 'Operating Systems', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('116', 'IFS2211', 'Information Systems Analysis and Design', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('117', 'STA2205', 'Statistical Computing', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('118', 'HRM2201', 'Organizational Behavior', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '1'),
('119', 'COS2221', 'Computer Systems', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '2'),
('120', 'ITE2203', 'Web Development', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '2'),
('121', 'ITE2204', 'Computer Networks', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '2'),
('122', 'IFS2221', 'Information Technology Project Management', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No','No', '2', '2'),
('123', 'STA2206', 'Data Mining', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '2'),
('124', 'HRM2202', 'Human Resource Management', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '2', '2'),
('125', 'COS3311', 'Software Engineering', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('126', 'ITE3301', 'Artificial Intelligence', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('127', 'ITE3302', 'Cybersecurity', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('128', 'IFS3311', 'Information Systems Security', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('129', 'STA3305', 'Data Science', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('130', 'HRM3301', 'Entrepreneurship', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '1'),
('131', 'COS3321', 'Computer Graphics', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2'),
('132', 'ITE3303', 'Cloud Computing', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2'),
('133', 'ITE3304', 'Internet of Things', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2'),
('134', 'IFS3321', 'IT Service Management', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2'),
('135', 'STA3306', 'Business Intelligence', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2'),
('136', 'HRM3302', 'Strategic Management', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', '3', '2');

INSERT INTO course (l_code, course_code, course_title, DIT, BIT, DCS, BCS, BIC, DIC, DSTAT, BSTAT, year, semester) VALUES
('101', 'UCC1101', 'English Language Skills', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '1', '1'),
('102', 'COS1100', 'Computer Fundamentals', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '1'),
('103', 'COS1101', 'Introduction to Computer Science', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '1'),
('104', 'MTH1101', 'Discrete Mathematics', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '1'),
('105', 'COS1102', 'Programming Fundamentals', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '1'),
('106', 'HRM1101', 'Principles and Practice of Management', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', '1', '1'),

('107', 'UCC1201', 'Communication Skills', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '1', '2'),
('108', 'COS1201', 'Data Structures and Algorithms', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '2'),
('109', 'COS1202', 'Computer Organization', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '2'),
('110', 'MTH1201', 'Calculus', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '2'),
('111', 'COS1203', 'Web Development', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '2'),
('112', 'STA1201', 'Probability and Statistics', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '1', '2'),

('113', 'COS2211', 'Object-Oriented Programming', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('114', 'COS2212', 'Computer Systems', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('115', 'COS2213', 'Database Systems', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('116', 'MTH2211', 'Linear Algebra', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('117', 'COS2214', 'Computer Networks', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('118', 'STA2201', 'Statistical Computing', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '1'),
('119', 'COS2221', 'Software Engineering', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('120', 'COS2222', 'Operating Systems', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('121', 'COS2223', 'Artificial Intelligence', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('122', 'MTH2221', 'Numerical Analysis', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('123', 'COS2224', 'Human-Computer Interaction', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('124', 'STA2202', 'Data Mining', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '2', '2'),
('125', 'COS3311', 'Computer Graphics', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('126', 'COS3312', 'Computer Vision', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('127', 'COS3313', 'Machine Learning', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('128', 'MTH3311', 'Computational Complexity', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('129', 'COS3314', 'Network Security', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('130', 'STA3301', 'Data Science', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '1'),
('131', 'COS3321', 'Cloud Computing', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2'),
('132', 'COS3322', 'Internet of Things', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2'),
('133', 'COS3323', 'Cybersecurity', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2'),
('134', 'MTH3321', 'Cryptography', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2'),
('135', 'COS3324', 'Computer Science Project', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2'),
('136', 'STA3302', 'Business Intelligence', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', '3', '2');

INSERT INTO course (l_code, course_code, course_title, DIT, BIT, DCS, BCS, BIC, DIC, DSTAT, BSTAT, year, semester) VALUES
('101', 'CHM1101', 'General Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '1'),
('102', 'CHM1102', 'Organic Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '1'),
('103', 'MTH1101', 'Mathematics for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '1'),
('104', 'PHY1101', 'Physics for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '1'),
('105', 'IND1101', 'Introduction to Industrial Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '1'),
('106', 'CHM1201', 'Analytical Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '2'),
('107', 'CHM1202', 'Physical Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '2'),
('108', 'MTH1201', 'Calculus for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '2'),
('109', 'PHY1201', 'Thermodynamics', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '2'),
('110', 'IND1201', 'Chemical Engineering Principles', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '1', '2'),
('111', 'CHM2211', 'Inorganic Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('112', 'CHM2212', 'Biochemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('113', 'IND2211', 'Unit Operations in Chemical Engineering', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('114', 'MTH2211', 'Statistics for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('115', 'PHY2211', 'Quantum Mechanics', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('116', 'IND2212', 'Chemical Plant Design', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '1'),
('117', 'CHM2221', 'Organic Synthesis', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '2'),
('118', 'CHM2222', 'Spectroscopy', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '2'),
('119', 'IND2221', 'Chemical Reaction Engineering', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '2'),
('120', 'MTH2221', 'Numerical Methods for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '2'),
('121', 'PHY2221', 'Electrochemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '2', '2'),
('122', 'IND2222', 'Process Control and Instrumentation', 'No', 'No', 'No', 'No', 'Yes','Yes', 'No', 'No', '2', '2'),
('123', 'CHM3311', 'Advanced Analytical Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('124', 'CHM3312', 'Medicinal Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('125', 'IND3311', 'Industrial Chemical Processes', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('126', 'MTH3311', 'Computational Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('127', 'PHY3311', 'Materials Science', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('128', 'IND3312', 'Environmental Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '1'),
('129', 'CHM3321', 'Polymer Chemistry', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2'),
('130', 'CHM3322', 'Catalysis', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2'),
('131', 'IND3321', 'Chemical Plant Management', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2'),
('132', 'MTH3321', 'Mathematical Modeling for Chemists', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2'),
('133', 'PHY3321', 'Nanotechnology', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2'),
('134', 'IND3322', 'Industrial Chemistry Project', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'No', 'No', '3', '2');

INSERT INTO course (l_code, course_code, course_title, DIT, BIT, DCS, BCS, BIC, DIC, DSTAT, BSTAT, year, semester) VALUES
('102', 'STA1101', 'Introduction to Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '1'),
('103', 'MTH1101', 'Calculus', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '1'),
('104', 'STA1102', 'Descriptive Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '1'),
('105', 'COM1101', 'Computer Applications', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '1'),
('106', 'ECO1101', 'Principles of Economics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '1'),
('108', 'STA1201', 'Probability Theory', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '2'),
('109', 'MTH1201', 'Linear Algebra', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '2'),
('110', 'STA1202', 'Inferential Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '2'),
('111', 'COM1201', 'Programming for Statisticians', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '2'),
('112', 'ECO1201', 'Economic Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '1', '2'),
('113', 'STA2211', 'Statistical Inference', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('114', 'MTH2211', 'Mathematical Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('115', 'STA2212', 'Regression Analysis', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('116', 'COM2211', 'Data Analysis with R', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('117', 'ECO2211', 'Econometrics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('118', 'STA2213', 'Time Series Analysis', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '1'),
('119', 'STA2221', 'Sampling Theory', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('120', 'MTH2221', 'Stochastic Processes', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('121', 'STA2222', 'Non-Parametric Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('122', 'COM2221', 'Data Mining', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('123', 'ECO2221', 'Applied Econometrics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('124', 'STA2223', 'Survival Analysis', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '2', '2'),
('125', 'STA3311', 'Advanced Statistical Inference', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('126', 'MTH3311', 'Computational Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('127', 'STA3312', 'Multivariate Analysis', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('128', 'COM3311', 'Machine Learning for Statisticians', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('129', 'ECO3311', 'Bayesian Econometrics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('130', 'STA3313', 'Statistical Computing', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '1'),
('131', 'STA3321', 'Advanced Regression Analysis', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2'),
('132', 'MTH3321', 'Mathematical Finance', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2'),
('133', 'STA3322', 'Spatial Statistics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2'),
('134', 'COM3321', 'Big Data Analytics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2'),
('135', 'ECO3321', 'Time Series Econometrics', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2'),
('136', 'STA3323', 'Statistics Project', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', '3', '2');


INSERT INTO course_results (regNo, course_code, grade, cr_status) VALUES
(2022-08-22245, 'UCC1101', 'B+', 'Passed'),
(2022-08-22245, 'UCC1100', 'A', 'Passed'),
(2022-08-22245, 'ITE1102', 'C+', 'Passed'),
(2022-08-22245, 'ITE1103', 'B-', 'Passed'),
(2022-08-22245, 'IFS1111', 'A', 'Passed'),

(2022-08-22245, 'UCC1201', 'B-', 'Passed'),
(2022-08-22245, 'COS1211', 'B+', 'Passed'),
(2022-08-22245, 'ITE1203', 'A', 'Passed'),
(2022-08-22245, 'ITE1204', 'C+', 'Passed'),
(2022-08-22245, 'ITE1202', 'B-', 'Passed'),

(2022-08-22246, 'UCC1101', 'B-', 'Passed'),
(2022-08-22246, 'UCC1100', 'B+', 'Passed'),
(2022-08-22246, 'ITE1102', 'A', 'Passed'),
(2022-08-22246, 'ITE1103', 'C+', 'Passed'),
(2022-08-22246, 'IFS1111', 'B-', 'Passed'),

(2022-08-22246, 'UCC1201', 'C+', 'Passed'),
(2022-08-22246, 'COS1211', 'A', 'Passed'),
(2022-08-22246, 'ITE1203', 'B+', 'Passed'),
(2022-08-22246, 'ITE1204', 'B-', 'Passed'),
(2022-08-22246, 'ITE1202', 'C-', 'Passed'),

(2022-08-22247, 'UCC1101', 'C+', 'Passed'),
(2022-08-22247, 'UCC1100', 'A', 'Passed'),
(2022-08-22247, 'ITE1102', 'B+', 'Passed'),
(2022-08-22247, 'ITE1103', 'B-', 'Passed'),
(2022-08-22247, 'IFS1111', 'C-', 'Passed'),
(2022-08-22247, 'HRM1101', 'F', 'Redo'),

(2022-08-22247, 'UCC1201', 'B+', 'Passed'),
(2022-08-22247, 'COS1211', 'B-', 'Passed'),
(2022-08-22247, 'ITE1203', 'C+', 'Passed'),
(2022-08-22247, 'ITE1204', 'A', 'Passed'),
(2022-08-22247, 'ITE1202', 'B+', 'Passed'),
(2022-08-22247, 'STA2105', 'C-', 'Passed'),

(2022-08-22248, 'UCC1101', 'B+', 'Passed'),
(2022-08-22248, 'UCC1100', 'B-', 'Passed'),
(2022-08-22248, 'ITE1102', 'C+', 'Passed'),
(2022-08-22248, 'ITE1103', 'A', 'Passed'),
(2022-08-22248, 'IFS1111', 'B+', 'Passed'),
(2022-08-22248, 'HRM1101', 'C-', 'Passed'),

(2022-08-22248, 'UCC1201', 'B+', 'Passed'),
(2022-08-22248, 'COS1211', 'B-', 'Passed'),
(2022-08-22248, 'ITE1203', 'C+', 'Passed'),
(2022-08-22248, 'ITE1204', 'A', 'Passed'),
(2022-08-22248, 'ITE1202', 'B+', 'Passed'),
(2022-08-22248, 'STA2105', 'C-', 'Passed');


INSERT INTO course_results (regNo, course_code, grade, cr_status) VALUES
(2022-08-22249, 'UCC1101', 'B+', 'Passed'),
(2022-08-22249, 'COS1100', 'A', 'Passed'),
(2022-08-22249, 'COS1101', 'C+', 'Passed'),
(2022-08-22249, 'MTH1101', 'B-', 'Passed'),
(2022-08-22249, 'COS1102', 'A', 'Passed'),

(2022-08-22249, 'UCC1201', 'B-', 'Passed'),
(2022-08-22249, 'COS1202', 'A', 'Passed'),
(2022-08-22249, 'MTH1201', 'C+', 'Passed'),
(2022-08-22249, 'COS1203', 'B-', 'Passed'),
(2022-08-22249, 'STA1201', 'D+', 'Passed'),

(2022-08-22250, 'UCC1101', 'B-', 'Passed'),
(2022-08-22250, 'COS1100', 'B+', 'Passed'),
(2022-08-22250, 'COS1101', 'A', 'Passed'),
(2022-08-22250, 'MTH1101', 'C+', 'Passed'),
(2022-08-22250, 'COS1102', 'B-', 'Passed'),

(2022-08-22250, 'UCC1201', 'C+', 'Passed'),
(2022-08-22250, 'COS1202', 'B+', 'Passed'),
(2022-08-22250, 'MTH1201', 'B-', 'Passed'),
(2022-08-22250, 'COS1203', 'C-', 'Passed'),
(2022-08-22250, 'STA1201', 'F', 'Redo'),

(2022-08-22257, 'UCC1101', 'C+', 'Passed'),
(2022-08-22257, 'COS1100', 'A', 'Passed'),
(2022-08-22257, 'COS1101', 'B+', 'Passed'),
(2022-08-22257, 'MTH1101', 'B-', 'Passed'),
(2022-08-22257, 'COS1102', 'C-', 'Passed'),
(2022-08-22257, 'HRM1101', 'F', 'Redo'),

(2022-08-22257, 'UCC1201', 'B+', 'Passed'),
(2022-08-22257, 'COS1201', 'B-', 'Passed'),
(2022-08-22257, 'COS1202', 'C+', 'Passed'),
(2022-08-22257, 'MTH1201', 'A', 'Passed'),
(2022-08-22257, 'COS1203', 'B+', 'Passed'),
(2022-08-22257, 'STA1201', 'C-', 'Passed'),

(2022-08-22258, 'UCC1101', 'B+', 'Passed'),
(2022-08-22258, 'COS1100', 'B-', 'Passed'),
(2022-08-22258, 'COS1101', 'C+', 'Passed'),
(2022-08-22258, 'MTH1101', 'A', 'Passed'),
(2022-08-22258, 'COS1102', 'B+', 'Passed'),
(2022-08-22258, 'HRM1101', 'C-', 'Passed'),

(2022-08-22258, 'UCC1201', 'B+', 'Passed'),
(2022-08-22258, 'COS1201', 'B-', 'Passed'),
(2022-08-22258, 'COS1202', 'C+', 'Passed'),
(2022-08-22258, 'MTH1201', 'A', 'Passed'),
(2022-08-22258, 'COS1203', 'B+', 'Passed'),
(2022-08-22258, 'STA1201', 'C-', 'Passed');