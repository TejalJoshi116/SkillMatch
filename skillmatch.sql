-- Table for storing user authentication information
CREATE TABLE user_authentication (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Table for storing client authentication information
CREATE TABLE client_authentication (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Table for storing user data
CREATE TABLE users (
    user_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    user_type ENUM('client', 'user') NOT NULL,
    client_id INT, -- Foreign key for clients
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

-- Table for storing client data
CREATE TABLE clients (
    client_id INT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
    contact_name VARCHAR(50),
    contact_email VARCHAR(100),
    contact_phone VARCHAR(20),
    user_id INT, -- Foreign key for users
    FOREIGN KEY (user_id) REFERENCES users(user_id)
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

-- Table for storing projects information
CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    project_title VARCHAR(100) NOT NULL,
    project_description TEXT,
    deadline DATE,
    payment_amount DECIMAL(10, 2), -- Assuming payment in a specific currency
    status ENUM('open', 'closed') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

-- Table for storing user applications to projects
CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    applicant_id INT,
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (applicant_id) REFERENCES users(user_id)
);

-- Table for storing project updates
CREATE TABLE project_updates (
    update_id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    update_text TEXT,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

-- Table for storing reviews given by clients to users
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    reviewer_id INT,
    review_text TEXT,
    rating DECIMAL(3, 2), -- Assuming ratings out of 5
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(project_id),
    FOREIGN KEY (reviewer_id) REFERENCES users(user_id)
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

-- Table for storing project recommendations based on user skills
CREATE TABLE recommendations (
    recommendation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recommended_project_id INT,
    recommendation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (recommended_project_id) REFERENCES projects(project_id)
);
