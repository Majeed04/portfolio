
CREATE DATABASE IF NOT EXISTS portfolio_db;

USE portfolio_db;

CREATE TABLE IF NOT EXISTS hero (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(255) NOT NULL,        
    title VARCHAR(255) NOT NULL,       
    location VARCHAR(255) NOT NULL,   
    image_url VARCHAR(255) NOT NULL,   
    linkedin_url VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL        
);


CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL          
);


CREATE TABLE IF NOT EXISTS recommendations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,       
    file_path VARCHAR(255) NOT NULL,
    icon VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period VARCHAR(100) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degree VARCHAR(255) NOT NULL,
    university VARCHAR(255) NOT NULL,
    period VARCHAR(100) NOT NULL,
    gpa VARCHAR(100) NOT NULL
);


CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    provider VARCHAR(255) NOT NULL,
    icon VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL
);


CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(100) NOT NULL,
    linkedin_name VARCHAR(255) NOT NULL,
    linkedin_url VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    coop_letter_path VARCHAR(255) NOT NULL 
);



INSERT INTO hero (name, title, location, image_url, linkedin_url, email) VALUES 
('Abdulmajeed AL-Naam', 'Senior Software Engineering Student', 'Hail / Riyadh, Saudi Arabia', 'images/IMG_2623.jpg', 'https://www.linkedin.com/in/abdulmajeed-a-alnaam/', 'abdulmajeed.a.alnaam@outlook.com');

INSERT INTO about (description) VALUES 
('Senior Software Engineering student at the University of Hail, with only Co-op training remaining for graduation. Experienced in <strong>Python</strong> and <strong>Java</strong>, with knowledge of software engineering principles, SDLC, and problem solving. Leading a <strong>60+ member Programming & Gaming Club</strong>, organizing technical workshops and events. Seeking a Software Engineering Co-op opportunity to apply my skills and gain practical industry experience.');

INSERT INTO recommendations (title, file_path, icon, color) VALUES 
('Recommendation Letter', 'Recommendation_letter_Abdulmajeed copy.pdf', 'fas fa-file-pdf', '#ea4335'),
('Reference Letter', 'Abdulmajeed Reference Letter copy.pdf', 'fas fa-file-pdf', '#ea4335'),
('Recommendation Letter 2', 'Abdulmajeed Abdullah AL-Naam copy.pdf', 'fas fa-file-pdf', '#ea4335');

INSERT INTO experience (period, job_title, company, description) VALUES
('2024/2 – 2024/9', 'Salesman Customer Service & Sales Advisor', 'Jarir bookstore', '<ul><li>Provided accurate product recommendations based on customer needs and successfully upsold services</li><li>Assisted in training new staff members</li><li>Ensured individual and team targets were consistently met</li><li>Contributed ideas for incentives that improved team performance</li></ul>'),
('2025/9 – 2026/3', 'Leader of the PG Club', 'PG Club | UOH', '<ul><li>Led and managed a student club with 60 active members focused on programming and gaming</li><li>Planned and supervised events, workshops, and competitive activities</li><li>Strengthened leadership, communication, and organizational skills through team coordination</li></ul>');

INSERT INTO education (degree, university, period, gpa) VALUES 
('Bachelor''s degree in Software Engineering', 'University Of Hail', '2022/8 – Present', '3.549 / 4.00');

INSERT INTO courses (name, provider, icon, description) VALUES 
('Java Programming Track', 'Satr Learning Platform', 'fab fa-java', '<ul><li>Learned the fundamentals of programming using Java.</li><li>Gained knowledge of Object-Oriented Programming (OOP) principles and their application in Java.</li><li>Developed essential programming skills for building applications using Java.</li></ul>'),
('Python Programming Course', 'Saudi Digital Academy (SDA)', 'fab fa-python', '<ul><li>Covered Python basics, control flow, collections, functions, file handling, and OOP.</li><li>Implemented error handling and clean code organization.</li></ul>');

INSERT INTO skills (name, type) VALUES 
('Python', 'tech'), ('Java', 'tech'), ('SDLC', 'tech'), ('Problem solving', 'tech'), ('Leadership', 'tech'), 
('Communication and public speaking', 'tech'), ('Attention to detail', 'tech'), ('Quick learner', 'tech'), 
('Teamwork', 'tech'), ('Ability to work under pressure', 'tech'), ('Adaptable and dependable', 'tech'),
('Arabic', 'lang'), ('English', 'lang');

INSERT INTO contact (email, phone, linkedin_name, linkedin_url, location, coop_letter_path) VALUES 
('abdulmajeed.a.alnaam@outlook.com', '050 060 5777', 'Abdulmajeed A. AL-Naam', 'https://www.linkedin.com/in/abdulmajeed-a-alnaam/', 'Hail / Riyadh, KSA', 'خطاب البحث عن جهة تدريب copy.pdf');
