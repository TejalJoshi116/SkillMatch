-- Table for storing user authentication data
CREATE TABLE user_auth (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Table for storing client authentication data
CREATE TABLE client_auth (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Table for storing client information
CREATE TABLE clients (
    client_id INT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
    contact_name VARCHAR(50),
    contact_email VARCHAR(100),
    contact_phone VARCHAR(20),
    FOREIGN KEY (client_id) REFERENCES client_auth(client_id)
);

-- Table for storing user information
CREATE TABLE users (
    user_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    user_type ENUM('client', 'user') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_auth(user_id)
);

-- Table for storing skills information
CREATE TABLE skills (
    skill_id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(50) NOT NULL
);

-- Table for mapping users to their skills (many-to-many relationship)
CREATE TABLE user_skills (
    user_id INT,
    skill_id INT,
    PRIMARY KEY (user_id, skill_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (skill_id) REFERENCES skills(skill_id)
);


-- Table for storing user resumes and previous projects
CREATE TABLE user_portfolio (
    portfolio_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    resume_path VARCHAR(255), -- Path to uploaded resume file
    previous_projects TEXT, -- JSON or serialized data for previous projects
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Table for storing notifications for users
CREATE TABLE notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    notification_text TEXT,
    is_read BOOLEAN DEFAULT 0,
    notification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


-- Table structure for table `event_organizer`
DROP TABLE IF EXISTS `project_client`;
CREATE TABLE IF NOT EXISTS `project_client` (
  `client_Id` int(11) NOT NULL AUTO_INCREMENT,
  `client_Name` varchar(64) NOT NULL,
  `Description` varchar(4096) NOT NULL,
  `Email_Id` varchar(64) NOT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `client_Type_Id` int(11) NOT NULL,
  PRIMARY KEY (`client_Id`),
  UNIQUE KEY `Email_Id` (`Email_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Inserting sample data into the project_client table
INSERT INTO `project_client` (`client_Name`, `Description`, `Email_Id`, `Picture`)
VALUES 
('Client A', 'Description for Client A', 'client_a@example.com', 'upload/pic1.png'),
('Client B', 'Description for Client B', 'client_b@example.com', 'upload/pic2.png'),
('Client C', 'Description for Client C', 'client_c@example.com', 'upload/pic3.jpg');


--
-- Table structure for table `project_status`
--

DROP TABLE IF EXISTS `project_status`;
CREATE TABLE IF NOT EXISTS `project_status` (
  `Status_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(32) NOT NULL,
  PRIMARY KEY (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`Status_Id`, `Status`) VALUES
(1, 'Registrations Open'),
(2, 'Registrations Closed'),
(3, 'Event Finished'),
(4, 'Event Started'),
(5, 'Submission Window Open'),
(6, 'Submission Window Closed'),
(7, 'Postponed'),
(8, 'Cancelled'),
(9, 'Seats Over'),
(10, 'Open For All');

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_Id` int(11) NOT NULL AUTO_INCREMENT,
  `project_Name` varchar(128) NOT NULL,
  `project_Date` date NOT NULL,
  `project_Start_Time` time DEFAULT NULL,
  `Description` varchar(4096) NOT NULL,
  `project_End_Time` time DEFAULT NULL,
  `project_Type_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `fee` int(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`project_Id`),
  KEY `project_Type_Id` (`project_Type_Id`),
  KEY `Status_Id` (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Table structure for table `project_type`
--

DROP TABLE IF EXISTS `project_type`;
CREATE TABLE IF NOT EXISTS `project_type` (
  `project_Type_Id` int(11) NOT NULL AUTO_INCREMENT,
  `project_Type_Name` varchar(64) NOT NULL,
  PRIMARY KEY (`project_Type_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_type`
--

INSERT INTO `project_type` (`project_Type_Id`, `project_Type_Name`) VALUES
(1, 'Web development'),
(2, 'Backend development'),
(3, 'Frontend development'),
(4, 'Fullstack development'),
(5, 'Data science');


--
-- Table structure for table `project_client_list`
--

DROP TABLE IF EXISTS `project_client_list`;
CREATE TABLE IF NOT EXISTS `project_client_list` (
  `project_Id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`project_Id`,`client_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_org_list`
--

INSERT INTO `project_client_list` (`project_Id`, `client_id`) VALUES
(4, 1),
(2, 2),
(3, 2),
(4, 2),
(6, 3),
(11, 3),
(9, 4),
(7, 5),
(8, 5),
(5, 6),
(12, 6),
(6, 9),
(1, 10),
(10, 10),
(13, 10);

-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `Event_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Name` varchar(128) NOT NULL,
  `Event_Date` date NOT NULL,
  `Event_Start_Time` date NOT NULL,
  `Description` varchar(4096) NOT NULL,
  `Event_End_Time` date NOT NULL,
  `Event_Limit` int(11) DEFAULT NULL,
  `Event_Type_Id` int(11) NOT NULL,
  `Location_Id` int(11) NOT NULL,
  `Status_Id` int(11) NOT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `fee` varchar(15) NOT NULL,
  PRIMARY KEY (`Event_Id`),
  KEY `Event_Type_Id` (`Event_Type_Id`),
  KEY `Location_Id` (`Location_Id`),
  KEY `Status_Id` (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Event_Id`, `Event_Name`, `Event_Date`, `Event_Start_Time`, `Description`, `Event_End_Time`, `Event_Limit`, `Event_Type_Id`, `Location_Id`, `Status_Id`, `Picture`, `fee`) VALUES
(1, 'Annual Sports Meet 2020-21', '2021-02-20', '08:00:00', 'The official Annual Sports Meet of NITC is back this year larger and better.', '18:00:00', 2000, 1, 31, 10, 'upload/Annual Sports Meet.jpg\r\n', 0),
(2, 'The Need of AI/ML in Robotics', '2021-01-15', '20:00:00', 'We are extremely glad to inform everyone that the next expert talk session in the AI club is on 15th January 2021, 6:30 PM  and we cordially invite everyone to attend the talk titled “The need of AI in Robotics for biomedical/rehabilitation” by Dr.S M Mizanoor Rahman, Assistant Professor, Department of Intelligent Systems and Robotics, University of West Florida. The talk will be for around 1 hour along with a Q & A session via Webex. ', '21:00:00', 500, 3, 32, 1, 'upload/needai.jpeg', 0),
(3, 'AI Adoption in Industry', '2021-01-30', '19:30:00', 'We are extremely excited to inform everyone that the very first expert talk series of AI club NITC is starting on 30th January 2021 at 7:30 PM and we cordially invite everyone to attend the talk titled “AI adoption in Industry: Healthcare and Lifesciences” by Mr. Raghav Mani, Product Manager for healthcare AI at NVIDIA, USA. The talk will be for around 1 hour along with a Q & A session via Webex. ', NULL, 500, 2, 32, 1, 'upload/WhatsApp Image 2020-12-22 at 10.46.36 AM.jpeg', 0),
(4, 'AI Workshop Object Detection', '2021-02-01', '10:30:00', 'The Computer Science and Engineering Association in coordination with Institute Innovation Council and the AI Club of NITC will be holding a workshop on ’Introduction to Object Detection’.  The workshop is open to students from all branches and years.The schedule for the workshop is as follows:\r\n\r\n\r\n\r\nDate\r\n\r\nTime\r\n\r\nTopic\r\n\r\n02/02/2021\r\n\r\n10am - 11am\r\n\r\nConvolutional Neural Networks\r\n\r\n\r\n\r\n11am - 12pm\r\n\r\nHands on session - CV2 and Matplotlib\r\n\r\n\r\n\r\n2pm - 3pm\r\n\r\nIntroduction to Object Detection\r\n\r\n03/02/2021\r\n\r\n10am - 12pm\r\n\r\nCentrenet\r\n\r\n\r\n\r\n2pm - 4pm\r\n\r\nHands on Session - Centrenet\r\n\r\n', NULL, 500, 5, 33, 1, 'upload/objdetection.jpeg', 0),
(5, 'Snakes N Ladders', '2021-01-07', '18:30:00', 'Exclusively for First Years', NULL, 1000, 6, 5, 1, 'upload/1.jpeg', 0),
(6, 'Rang De Basanti', '2021-03-11', NULL, 'Official Holi Event', NULL, 1, 6, 4, 1, 'upload/WhatsApp Image 2020-12-22 at 10.52.03 AM (2).jpeg', 0),
(7, 'Urban Folktales ft. Shibili Suhanah', '2021-01-08', '16:00:00', 'Urban Folktales Part 1', NULL, 500, 2, 36, 1, 'upload/WhatsApp Image 2020-12-22 at 10.52.03 AM (3).jpeg', 0),
(8, 'Urban Folktales ft. Kani Kasruti', '2021-01-21', NULL, 'Ft Kani Kasruti', NULL, 500, 2, 36, 10, 'upload/WhatsApp Image 2020-12-22 at 10.52.03 AM (6).jpeg', 0),
(9, 'Dub It Up', '2021-01-18', NULL, 'Dub It Up. Submission Event. Judge is RJ Shelvin', NULL, 500, 14, 32, 5, 'upload/dub.jpeg', 0),
(10, 'Willow Cup 2021', '2021-02-18', NULL, 'Willow Cup 2k19\r\n\"It\'s all about how you perform when given the chance\"\r\nWillow Cup 2k19 provides your team with the golden\r\nopportunity to prove their mettle with their display of amazing cricket.\r\nRaise your fitness levels and get ready to witness some breathtaking and mind-blowing action.\r\nPump yourself up to clobber scintillating sixes, take stupendous catches, instill fear in the minds of the batsmen with toe-crushing yorkers and searing bouncers, and lead your team to everlasting glory.\r\n\"Play. Endure. Sustain. Grow\"', NULL, NULL, 1, 31, 1, 'upload/WhatsApp Image 2020-12-22 at 12.01.24 PM.jpeg', 0),
(11, 'Svaraa', '2021-02-05', NULL, 'Sing your melodies and submit at ica@nitc.ac.in', NULL, NULL, 14, 32, 5, 'upload/WhatsApp Image 2020-12-22 at 10.52.03 AM.jpeg', 0),
(12, 'Newton #2 Speaks ft Harishankaran K', '2021-02-19', NULL, 'Get a chance to interact with Harishankaran K, Co-founder & CTO of Hackerrank', NULL, 300, 2, 33, 1, 'upload/newton.jpeg', 1),
(13, 'Badminton Tournament', '2021-04-16', '00:00:00', 'Inter Hostel Badminton Tournament', '00:00:00', 50, 1, 15, 10, 'upload/Badminton Tournament-badminton.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_contact`
--

DROP TABLE IF EXISTS `event_contact`;
CREATE TABLE IF NOT EXISTS `event_contact` (
  `event_id` int(11) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `Name` varchar(32) NOT NULL,
  PRIMARY KEY (`event_id`,`contact_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_contact`
--

INSERT INTO `event_contact` (`event_id`, `contact_no`, `Name`) VALUES
(1, '8297274955', 'Vimal Rajesh'),
(2, '8297274955', 'Vimal Rajesh'),
(3, '9370861715', 'Kunal Jagtap'),
(4, '123575', 'Arun'),
(5, '9811981140', 'Alok Raj'),
(6, '9819405432', 'Argah'),
(7, '9765456545', 'Arjun'),
(8, '9765456545', 'Arjun'),
(9, '9310931099', 'Abhishek Pawar'),
(10, '8297274955', 'Vimal Rajesh'),
(11, '9493019459', 'Dheeraj Reddy'),
(12, '6736738090', 'Advait');

-- --------------------------------------------------------

--
-- Table structure for table `event_location`
--

DROP TABLE IF EXISTS `event_location`;
CREATE TABLE IF NOT EXISTS `event_location` (
  `Location_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Location_Name` varchar(64) NOT NULL,
  PRIMARY KEY (`Location_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_location`
--

INSERT INTO `event_location` (`Location_Id`, `Location_Name`) VALUES
(1, 'Aryabhatta Hall'),
(2, 'Bhaskara Hall'),
(3, 'Chanakya Hall'),
(4, 'ELHC Pits'),
(5, 'NLHC'),
(6, 'ELHC'),
(7, 'ECLC'),
(8, 'Department of Architecture and Planning'),
(9, 'Department of Chemical Engineering'),
(10, 'School of Biotechnology'),
(11, 'Department of Physics'),
(12, 'Mathematics Department'),
(13, 'Department of Electronics and Communication Engineering Block I'),
(14, 'Department of Electronics and Communication Engineering Block II'),
(15, 'Auditorium'),
(16, 'Computer Science and Engineering Department'),
(17, 'Department of Civil Engineering'),
(18, 'Mechanical Engineering Department'),
(19, 'PG Block'),
(20, 'EEE Block'),
(21, 'Training & Placement Department'),
(22, 'Rajpath'),
(23, 'Main Building'),
(24, 'Creative Zone'),
(25, 'Hockey Ground'),
(26, 'Football Ground'),
(27, 'Kho-Kho Court'),
(28, 'Kabaddi Ground'),
(29, 'Volleyball Court'),
(30, 'Rajpath'),
(31, '12th Mile Grounds'),
(32, 'Virtual Mode'),
(33, 'Webex'),
(34, 'Zoom'),
(35, 'Microsoft Teams'),
(36, 'Google Meet'),
(37, 'Main Campus'),
(38, 'School of Management Studies (SOMS)');

-- --------------------------------------------------------

--
-- Table structure for table `event_organizer`
--

DROP TABLE IF EXISTS `event_organizer`;
CREATE TABLE IF NOT EXISTS `event_organizer` (
  `Organizer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Organizer_Name` varchar(64) NOT NULL,
  `Description` varchar(4096) NOT NULL,
  `Email_Id` varchar(64) NOT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `Organizer_Type_Id` int(11) NOT NULL,
  PRIMARY KEY (`Organizer_Id`),
  UNIQUE KEY `Email_Id` (`Email_Id`),
  KEY `Organizer_Type_Id` (`Organizer_Type_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_organizer`
--

INSERT INTO `event_organizer` (`Organizer_Id`, `Organizer_Name`, `Description`, `Email_Id`, `Picture`, `Organizer_Type_Id`) VALUES
(1, 'CSEA', 'The Computer Science and Engineering Association (CSEA) is an integral part of the Computer Science and Engineering Department of NIT Calicut. Over the years, CSEA has encouraged the academic and scientific development of the department\'s student body through activities such as coding competitions, technical workshops and talks by eminent researchers. Annually, the CSEA hosts Code Maestros, Technical workshops, Linux Fest, FOSSMeet and job/internship talks', 'csea@nitc.ac.in', 'upload/CSEA.jpg', 4),
(2, 'AI Club', 'The AI Club of NITC', 'aiclub@nitc.ac.in', 'upload/AI.png', 1),
(3, 'ICA', 'Indian Cultural Association (ICA) of NITC', 'ica@nitc.ac.in', 'upload/ICA.jpg', 2),
(4, 'Forum for Dance and Dramatics (DND)', 'The official forum for dance and dramatics of NITC.', 'dnd@nitc.ac.in', 'upload/DND.jpg', 2),
(5, 'Audio Visual (AV) Club', 'The Audio Visual Club of NITC', 'avclub@nitc.ac.in', 'upload/AV.png', 2),
(6, 'Indian Society for Technical Education (ISTE)', 'The ISTE Club of NITC', 'iste@nitc.ac.in', 'upload/ISTE.jpg', 2),
(7, 'Team Unwired', 'The official Team Unwired of NITC', 'teamunwired@nitc.ac.in', 'upload/TeamUnwired.png', 1),
(8, 'Aero Unwired', 'The official Aero Unwired of NITC', 'aerounwired@nitc.ac.in', 'upload/aerounwired.jpg', 1),
(9, 'Students Affairs Council (SAC)', 'The Students Affairs Council of NITC', 'sac@nitc.ac.in', 'upload/sac.jpg', 5),
(10, 'Sports Club NITC', 'The Sports Club of NITC', 'sportsclub@nitc.ac.in', 'upload/sports.png', 6);

-- --------------------------------------------------------

--
-- Table structure for table `event_org_list`
--

DROP TABLE IF EXISTS `event_org_list`;
CREATE TABLE IF NOT EXISTS `event_org_list` (
  `Event_Id` int(11) NOT NULL,
  `Organizer_id` int(11) NOT NULL,
  PRIMARY KEY (`Event_Id`,`Organizer_id`),
  KEY `Organizer_id` (`Organizer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `event_org_list`
--

INSERT INTO `event_org_list` (`Event_Id`, `Organizer_id`) VALUES
(4, 1),
(2, 2),
(3, 2),
(4, 2),
(6, 3),
(11, 3),
(9, 4),
(7, 5),
(8, 5),
(5, 6),
(12, 6),
(6, 9),
(1, 10),
(10, 10),
(13, 10);

-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Id` int(11) NOT NULL,
  `UserId` char(9) CHARACTER SET utf8 NOT NULL,
  `message` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `Event_Id` (`Event_Id`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `Event_Id`, `UserId`, `message`, `Timestamp`) VALUES
(16, 2, 'B180336CS', 'Dear VIMAL RAJESH, Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:29:38'),
(17, 2, 'B180411CS', 'Dear ALOK RAJ, Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:29:38'),
(18, 2, 'B180902CS', 'Dear PUCHAKAYALA DHEERAJ REDDY, Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:29:38'),
(19, 2, 'B180921CS', 'Dear KUNAL RAVIKUMAR JAGTAP, Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:29:38'),
(20, 2, 'B180336CS', 'Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:30:43'),
(21, 2, 'B180411CS', 'Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:30:43'),
(22, 2, 'B180902CS', 'Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:30:43'),
(23, 2, 'B180921CS', 'Hey Everyone We will be shifting Location to CZ since we did not get permission for Auditorium. Sorry for the inconvenience caused.', '2021-01-02 15:30:43'),
(25, 12, 'B180454CS', 'Dear P ARJUN, the status of Event Newton #2 Speaks ft Harishankaran Khas changed to Registrations Open', '2021-01-02 16:48:51'),
(27, 12, 'B180454CS', 'We are soory to postpone to event to some further date', '2021-01-02 16:50:02'),
(28, 2, 'B180902CS', 'Hey Friend', '2021-01-02 17:11:02'),
(32, 12, 'B180454CS', 'Your Document was inadequate', '2021-01-02 20:21:12'),
(34, 2, 'B180336CS', 'Dear VIMAL RAJESH, the answer to your Query I am interested in this event. How to register? is:<br>Click on register macha', '2021-01-02 21:51:49'),
(35, 2, 'B180336CS', 'Dear VIMAL RAJESH, the answer to your Query \'I am interested in this event. How to register?\' is: Click on register macha', '2021-01-02 21:54:17'),
(36, 2, 'B180336CS', 'Dear VIMAL RAJESH, the answer to your Query \'I am interested in this event. How to register?\' is: Click on register macha', '2021-01-02 21:56:16'),
(37, 2, 'B180336CS', 'Dear VIMAL RAJESH, the answer to your Query \'I am interested in this event. How to register?\' is: Click Register', '2021-01-02 22:02:06');


-- Table structure for table `event_type`
--

DROP TABLE IF EXISTS `event_type`;
CREATE TABLE IF NOT EXISTS `event_type` (
  `Event_Type_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Type_Name` varchar(64) NOT NULL,
  PRIMARY KEY (`Event_Type_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`Event_Type_Id`, `Event_Type_Name`) VALUES
(1, 'Website development'),
(2, 'Mobile app development'),
(3, 'Software Development'),
(4, 'Database Management'),
(5, 'Data Analysis'),
(6, 'Game Development'),
(7, 'UI/UX Design'),
(8, 'Machine Learning'),
(9, 'Artificial Intelligence'),
(10, 'Augmented Reality (AR) / Virtual Reality (VR)'),
(11, 'Cybersecurity Analysis');

-- Table structure for table `event_status`
--

DROP TABLE IF EXISTS `event_status`;
CREATE TABLE IF NOT EXISTS `event_status` (
  `Status_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(32) NOT NULL,
  PRIMARY KEY (`Status_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_status`
--

INSERT INTO `event_status` (`Status_Id`, `Status`) VALUES
(1, 'Applications Open'),
(2, 'Applications Closed'),
(3, 'Open for all');